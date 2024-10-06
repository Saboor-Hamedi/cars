<?php

namespace App\Livewire\Chat;

use Carbon\Carbon;
use Exception;
use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\File;
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
            'time' => $this->CurrentTime()
        ];
        $this->message = '';

        // Get bot response with error handling
        try {
            $botResponse = $this->getBotResponse(end($this->messages)['text']);
            $this->messages[] = [
                'user' => 'Bot',
                'text' => $botResponse,
                'time' => $this->CurrentTime()
            ];
        } catch (Exception $e) {
            $this->messages[] = [
                'user' => 'Bot',
                'text' => 'Oops! Something went wrong while processing your request. Please try again later.',
                'time' => $this->CurrentTime()
            ];
        }
        $this->dispatch('scroll-to-bottom');
    }

    public function toggleChat()
    {
        $this->isOpen = !$this->isOpen;
        session(['chatbox-open' => $this->isOpen]);
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'messages') {
            $this->scrollToBottom();
        }
    }

    public function scrollToBottom()
    {
        $this->dispatch('scroll-to-bottom');
    }

    private function getBotResponse($message)
    {

        $this->loadQueries();
        try {
            // $this->queries = app('chatbot.queries');
            // $cleanMessage = $this->sanitizeMessage($message);
            // // Check if the user's message matches any of the supported queries
            // foreach ($this->queries as $query => $response) {
            //     if (stripos($cleanMessage, $query) !== false) {
            //         // Return the response and follow-up question (if any)
            //         return $response['response'] . ($response['follow_up'] ? "\n\n" . $response['follow_up'] : '');
            //     }
            // }
            if (empty($this->queries)) {
                throw new Exception('Failed to load queries');
            }
            $cleanMessage = $this->sanitizeMessage($message);
            Log::debug('Clean message: ' . $cleanMessage);
            foreach ($this->queries as $query => $response) {
                Log::debug('Checking query: ' . $query);
                if (stripos(strtolower($cleanMessage), strtolower($query)) !== false) {
                    Log::debug('Query matched: ' . $query);
                    return $response['response'] . ($response['follow_up'] ? "\n\n" . $response['follow_up'] : '');
                }
            }
            Log::debug('No query matched');
            return $this->cantAnswer();
        } catch (Exception $e) {
            Log::error('Chatbot query processing error: ' . $e->getMessage());
        }
    }
    // load data.json


    private function cantAnswer()
    {
        return "I'm not sure how to answer that, but I'm here to help! 🤔 Please ask about the school, and I'll do my best to assist you.";
    }

    private function getPrimaryInfo()
    {
        return [
            'title' => 'Primary School',
            'description' => 'Our primary school is designed for students aged 5-11. We offer a comprehensive curriculum that includes English, math, science, and social studies. Our primary school is known for its small class sizes and experienced teachers.',
        ];
    }

    private function getSeniorInfo()
    {
        return [
            'title' => 'Senior School',
            'description' => 'Our senior school is designed for students aged 12-16. We offer a wide range of subjects, including English, math, science, and social studies, as well as elective courses in areas such as music, art, and drama. Our senior school is known for its academic excellence and supportive community.',
        ];
    }

    private function getHighInfo()
    {
        return [
            'title' => 'High School',
            'description' => 'Our high school is designed for students aged 17-18. We offer a range of subjects, including English, math, science, and social studies, as well as elective courses in areas such as business, technology, and the arts. Our high school is known for its academic rigor and preparation for university.',
        ];
    }

    public function showPrimaryInfo()
    {
        $this->messages[] = [
            'user' => 'Bot',
            'text' => $this->getPrimaryInfo()['description'],
            'time' => $this->CurrentTime()
        ];
        $this->disableButton('primary');
        $this->dispatch('scroll-to-bottom');
    }

    public function showSeniorInfo()
    {
        $this->messages[] = [
            'user' => 'Bot',
            'text' => $this->getSeniorInfo()['description'],
            'time' => $this->CurrentTime()
        ];
        $this->disableButton('senior');
        $this->dispatch('scroll-to-bottom');
    }

    public function showHighInfo()
    {
        $this->messages[] = [
            'user' => 'Bot',
            'text' => $this->getHighInfo()['description'],
            'time' => $this->CurrentTime()
        ];
        $this->disableButton('high');
        $this->dispatch('scroll-to-bottom');
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

    public function enableButton($button)
    {
        if ($button === 'primary') {
            $this->primaryButtonDisabled = false;
        } elseif ($button === 'senior') {
            $this->seniorButtonDisabled = false;
        } elseif ($button === 'high') {
            $this->highButtonDisabled = false;
        }
    }

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

    public function updateButtonStates()
    {

        // if ($this->getMessages()) {
        //     $this->resetChat();
        // }
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
    private function CurrentTime()
    {
        // return date('h:i:s A');
        return Carbon::now()->format('h:i:s A');
    }
    public function render()
    {
        return view('livewire.chat.chatbot');
    }
}
