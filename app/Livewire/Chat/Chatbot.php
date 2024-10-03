<?php

namespace App\Livewire\Chat;

use HTMLPurifier;
use HTMLPurifier_Config;
use Livewire\Component;

class Chatbot extends Component
{
    public $messages = [];
    public $message;
    public $isOpen = false;

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

        // senitize
        $cleanMessage = $this->sanitizeMessage($this->message);
        $this->messages[] = [
            'user' => 'You',
            'text' => $cleanMessage,
            'time' => now()->format('H:i')
        ];
        $this->message = '';

        $botResponse = $this->getBotResponse(end($this->messages)['text']);

        $this->messages[] = [
            'user' => 'Bot',
            'text' => $botResponse,
            'time' => now()->format('H:i')
        ];
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
        // Remove special characters from the user's message

        $cleanMessage = $this->sanitizeMessage($message);
        $queries = [
            'fee' => [
                'response' => 'Sure thing! Here’s our fee structure: ... (insert fee structure here)',
                'follow_up' => 'Would you like to know more about our admission process?',
            ],
            'admission' => [
                'response' => 'Of course! Here’s our admission process: ... (insert admission process here)',
                'follow_up' => 'Would you like to know more about our fee structure?',
            ],
            'grades' => [
                'response' => 'No problem! Here’s what we offer: ... (insert grades here)',
                'follow_up' => 'Would you like to know more about our curriculum?',
            ],
            'primary' => [
                'response' => 'Our primary school is designed for students aged 5-11. We offer a comprehensive curriculum that includes English, math, science, and social studies. Our primary school is known for its small class sizes and experienced teachers.',
                'follow_up' => 'Would you like to know more about our primary school curriculum or admission process?',
            ],
            'senior' => [
                'response' => 'Our senior school is designed for students aged 12-16. We offer a wide range of subjects, including English, math, science, and social studies, as well as elective courses in areas such as music, art, and drama. Our senior school is known for its academic excellence and supportive community.',
                'follow_up' => 'Would you like to know more about our senior school curriculum or admission process?',
            ],
            'high' => [
                'response' => 'Our high school is designed for students aged 17-18. We offer a range of subjects, including English, math, science, and social studies, as well as elective courses in areas such as business, technology, and the arts. Our high school is known for its academic rigor and preparation for university.',
                'follow_up' => 'Would you like to know more about our high school curriculum or admission process?',
            ],
            // Add more queries and responses as needed
        ];
        // Check if the user's message matches any of the supported queries
        foreach ($queries as $query => $response) {
            if (stripos($cleanMessage, $query) !== false) {
                // Return the response and follow-up question (if any)
                return $response['response'] . ($response['follow_up'] ? "\n\n" . $response['follow_up'] : '');
            }
        }
        return $this->cantAnswer();
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
        if (!$this->primaryButtonDisabled) {
            $this->messages[] = [
                'user' => 'Bot',
                'text' => $this->getPrimaryInfo()['description'],
                'time' => now()->format('H:i')
            ];
            $this->primaryButtonDisabled = true;
            $this->dispatch('scroll-to-bottom');
        }
    }

    public function showSeniorInfo()
    {
        if (!$this->seniorButtonDisabled) {
            $this->messages[] = [
                'user' => 'Bot',
                'text' => $this->getSeniorInfo()['description'],
                'time' => now()->format('H:i')
            ];
            $this->seniorButtonDisabled = true;
            $this->dispatch('scroll-to-bottom');
        }
    }

    public function showHighInfo()
    {
        if (!$this->highButtonDisabled) {
            $this->messages[] = [
                'user' => 'Bot',
                'text' => $this->getHighInfo()['description'],
                'time' => now()->format('H:i')
            ];
            $this->highButtonDisabled = true;
            $this->dispatch('scroll-to-bottom');
        }
    }




    private function sanitizeMessage($message)
    {
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $cleanMessage = preg_replace('/[^a-zA-Z0-9\s]/', '', $message);
        return $purifier->purify($cleanMessage);
    }
    public function render()
    {
        return view('livewire.chat.chatbot');
    }
}
