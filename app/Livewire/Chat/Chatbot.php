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
    // protected $queries = [];

    public $primaryButtonDisabled = false;
    public $seniorButtonDisabled = false;
    public $highButtonDisabled = false;



    protected $chatService;

    public function __construct()
    {
        $this->chatService = new ChatService();
    }
    public function mount()
    {
        $this->isOpen = session()->has('chatbox-open') ? session('chatbox-open') : false;

    }
    public function loadQueries()
    {
        // $filePath = storage_path('data.json');
        $filePath = storage_path() . DIRECTORY_SEPARATOR . 'data.json';
        // dd($filePath);
        if (file_exists($filePath)) {
            try {
                $jsonData = file_get_contents($filePath);
                // dd($jsonData);
                $this->queries = json_decode($jsonData, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new Exception('Error loading chatbot queries from JSON: ' . json_last_error_msg());
                }
            } catch (Exception $e) {
                Log::error('Error loading chatbot queries from JSON: ' . $e->getMessage());
                $this->queries = []; // Set to an empty array in case of loading errors
            }
        } else {
            $this->queries = []; // Set to an empty array if file not found
            Log::error('Error loading chatbot queries from JSON: File not found');
        }
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
        $this->loadQueries();
        $cleanMessage = $this->sanitizeMessage($message);
        try {
            if (empty($this->queries)) {
                throw new Exception('Failed to load queries');
            }

            Log::debug('Clean message: ' . $cleanMessage);
            foreach ($this->queries as $query => $response) {
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
        $this->disableButton($button);
        // $this->dispatch('scroll-to-bottom');
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

    private function disableButton($button)
    {
        if ($button === 'primary') {
            $this->primaryButtonDisabled = true;
        } elseif ($button === 'senior') {
            $this->seniorButtonDisabled = true;
        } elseif ($button === 'high') {
            $this->highButtonDisabled = true;
        }
        $this->dispatch('start-button-timer', ['button' => $button]);
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
        $this->resetButtonStates(); // Reset button states
        $this->clearSession(); // Clear any relevant session data
    }

    private function resetButtonStates(): void
    {
        // Reset the button states to their default enabled statuses
        $this->primaryButtonDisabled = false;
        $this->seniorButtonDisabled = false;
        $this->highButtonDisabled = false;
    }

    private function clearSession(): void
    {
        session()->forget('chatbox-open');
        session()->forget('getMessage'); // Clear any specific session keys (if applicable)
    }

    public function rules(): array
    {
        return [
            'message' => 'required|min:1|max:50'
        ];
    }
    // private function CurrentTime()
    // {
    //     // return date('h:i:s A');
    //     return Carbon::now()->format('h:i:s A');
    // }
    private function sanitizeMessage($message)
    {
        $config = HTMLPurifier_Config::createDefault();

        // Configure HTMLPurifier to allow stickers (assuming stickers are represented by specific HTML elements or classes)
        $config->set('HTML.AllowedElements', 'img'); // Allowing only img elements, modify as needed
        $config->set('HTML.AllowedAttributes', 'img.src,img.alt,img.class'); // Allowing only specific attributes for img

        $purifier = new HTMLPurifier($config);
        // Allow letters, numbers, spaces, @, and certain special characters used in stickers
        $cleanMessage = preg_replace('/[^a-zA-Z0-9\s@#\-_.:;,!()]/', '', $message);

        return $purifier->purify($cleanMessage);
    }

    public function render()
    {
        return view('livewire.chat.chatbot');
    }
}
