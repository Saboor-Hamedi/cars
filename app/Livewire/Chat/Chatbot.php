<?php

namespace App\Livewire\Chat;

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

    protected $rules = [
        'message' => 'required|min:1|max:50'
    ];
    public function mount()
    {
        $this->isOpen = session()->has('chatbox-open') ? session('chatbox-open') : false;
        if (!$this->isOpen) {
            $this->dispatch('chat-box-closed');
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
            'time' => now()->format('H:i')
        ];
        $this->message = '';

        // Get bot response with error handling
        try {
            $botResponse = $this->getBotResponse(end($this->messages)['text']);
            $this->messages[] = [
                'user' => 'Bot',
                'text' => $botResponse,
                'time' => now()->format('H:i')
            ];
        } catch (Exception $e) {
            $this->messages[] = [
                'user' => 'Bot',
                'text' => 'Oops! Something went wrong while processing your request. Please try again later.',
                'time' => now()->format('H:i')
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
        $this->dispatchBrowserEvent('scroll-to-bottom');

    }
    private function getBotResponse($message)
    {
        try {
            $this->queries = app('chatbot.queries');
            $cleanMessage = $this->sanitizeMessage($message);
            // Check if the user's message matches any of the supported queries
            foreach ($this->queries as $query => $response) {
                if (stripos($cleanMessage, $query) !== false) {
                    // Return the response and follow-up question (if any)
                    return $response['response'] . ($response['follow_up'] ? "\n\n" . $response['follow_up'] : '');
                }
            }
            return $this->cantAnswer();
        } catch (Exception $e) {
            Log::error('Chatbot query processing error: ' . $e->getMessage());
        }
    }

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
            'time' => now()->format('H:i')
        ];
        $this->disableButton('primary');
        $this->dispatch('scroll-to-bottom');
    }

    public function showSeniorInfo()
    {
        $this->messages[] = [
            'user' => 'Bot',
            'text' => $this->getSeniorInfo()['description'],
            'time' => now()->format('H:i')
        ];
        $this->disableButton('senior');
        $this->dispatch('scroll-to-bottom');
    }

    public function showHighInfo()
    {
        $this->messages[] = [
            'user' => 'Bot',
            'text' => $this->getHighInfo()['description'],
            'time' => now()->format('H:i')
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

    public function render()
    {
        return view('livewire.chat.chatbot');
    }
}
