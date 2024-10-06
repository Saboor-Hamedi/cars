<?php

namespace App\Livewire\Chat;

use Carbon\Carbon;
use Exception;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Chatbot extends Component
{
    public $messages = [];
    public $message;
    public $isOpen = false;
    protected $queries;
    public $primaryButtonDisabled = false;
    public $seniorButtonDisabled = false;
    public $highButtonDisabled = false;

    protected ?ChatService $chatService = null;

    public function __construct()
    {
        $this->chatService = new ChatService();
    }
    public function mount()
    {

        $this->isOpen = session()->has('chatbox-open') ? session('chatbox-open') : false;
    }
    public function rules(): array
    {
        return [
            'message' => 'required|min:1|max:50'
        ];
    }

    public function sendMessage()
    {
        $this->validate();

        // Sanitize and log the user message
        $cleanMessage = $this->sanitizeMessage($this->message);
        $this->messages[] = [
            'user' => 'You',
            'text' => $cleanMessage,
            'time' => $this->chatService->CurrentTime()
        ];
        $this->message = '';

        // Get bot response with error handling
        try {
            $botResponse = $this->getBotResponse(end($this->messages)['text']);
            $this->messages[] = [
                'user' => 'Bot',
                'text' => $botResponse,
                'time' => $this->chatService->CurrentTime()
            ];
        } catch (Exception $e) {
            $this->messages[] = [
                'user' => 'Bot',
                'text' => 'Oops! Something went wrong while processing your request. Please try again later.',
                'time' => $this->chatService->CurrentTime()
            ];
        }
        $this->dispatch('scroll-to-bottom');
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
        session(['chatbox-open' => $this->isOpen]);
    }

    private function getBotResponse($message)
    {
        $this->chatService->loadQueries();
        $cleanMessage = $this->sanitizeMessage($message);
        try {
            if (empty($this->chatService->queries)) {
                throw new Exception('Failed to load queries');
            }

            Log::debug('Clean message: ' . $cleanMessage);
            foreach ($this->chatService->queries as $query => $response) {
                Log::debug('Checking query: ' . $query);
                if (stripos(strtolower($cleanMessage), strtolower($query)) !== false) {
                    Log::debug('Query matched: ' . $query);
                    return $response['response'] . ($response['follow_up'] ? "\n\n" . $response['follow_up'] : '');
                }
            }
            Log::debug('No query matched');

            return $this->chatService->cantAnswer();
        } catch (Exception $e) {
            Log::error('Chatbot query processing error: ' . $e->getMessage());
        }
    }
    public function showInfo($button)
    {
        $infoMethods = [
            'primary' => 'getPrimaryInfo',
            'senior' => 'getSeniorInfo',
            'high' => 'getHighInfo',
        ];

        if (!isset($infoMethods[$button])) {
            throw new Exception('Invalid button type');
        }
        $info = $this->chatService->{$infoMethods[$button]}();
        $this->messages[] = [
            'user' => 'Bot',
            'text' => $info['description'],
            'time' => $this->chatService->CurrentTime()
        ];
        $this->chatService->disableButton($this, $button);
        $this->dispatch('scroll-to-bottom');
    }

    public function showPrimaryInfo()
    {
        $this->showInfo('primary');
    }

    public function showSeniorInfo()
    {
        $this->showInfo('senior');
    }

    public function showHighInfo()
    {
        $this->showInfo('high');
    }

    public function updateButtonStates()
    {
        if ($this->hasMessages()) {
            $this->resetChat();
        }
    }
    private function hasMessages(): bool
    {
        return !empty($this->messages);
    }
    private function resetChat(): void
    {
        $this->messages = []; // Clear all chat messages
        $this->message = ''; // Clear the message input
        $this->chatService->resetButtonStates($this);
        $this->chatService->clearSession($this);
    }
    private function sanitizeMessage($message)
    {
        $config = HTMLPurifier_Config::createDefault();
        $config->set('HTML.AllowedElements', 'img');
        $config->set('HTML.AllowedAttributes', 'img.src,img.alt,img.class');

        $purifier = new HTMLPurifier($config);
        // Allow letters, numbers, spaces, @, and certain special characters used in stickers
        $cleanMessage = preg_replace('/[^a-zA-Z0-9\s@#\-_.:;,!()]/', '', $message);
        return $purifier->purify($cleanMessage);
    }

    public function render()
    {
        $filePath = storage_path() . DIRECTORY_SEPARATOR . 'data.json';
        $whatsapp = file_get_contents($filePath);
        $dataJson = json_decode($whatsapp, true);
        return view('livewire.chat.chatbot', ['dataJson' => $dataJson]);
    }
}
