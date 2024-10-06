<?php
namespace App\Livewire\Chat;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
class ChatService extends Component
{

    public $primaryButtonDisabled = false;
    public $seniorButtonDisabled = false;
    public $highButtonDisabled = false;
    public $messages = [];
    public $message;
    public $queries;
    public function loadQueries()
    {
        // $filePath = storage_path('data.json');
        $filePath = storage_path() . DIRECTORY_SEPARATOR . 'data.json';
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

    public function getQueries()
    {
        return $this->queries;
    }
    public function cantAnswer()
    {
        return "I'm not sure how to answer that, but I'm here to help! 🤔 Please ask about the school, and I'll do my best to assist you.";

    }
    public function getPrimaryInfo()
    {

        if ($this->queries === null) {
            $this->loadQueries();
            return [
                'title' => 'Primary School',
                'description' => $this->queries['primary']['response'],
            ];
        } else {
            return [
                'title' => 'Primary School',
                'description' => 'Our primary school is designed for students aged 5-11. We offer a comprehensive curriculum that includes English, math, science, and social studies. Our primary school is known for its small class sizes and experienced teachers.',
            ];
        }
    }

    public function getSeniorInfo()
    {
        if ($this->queries === null) {
            $this->loadQueries();
            return [
                'title' => 'Senior School',
                'description' => $this->queries['senior']['response'],
            ];

        } else {
            return [
                'title' => 'High School',
                'description' => 'Our senior school is designed for students aged 12-16. We offer a wide range of subjects, including English, math, science, and social studies, as well as elective courses in areas such as music, art, and drama. Our senior school is known for its academic excellence and supportive community.',
            ];
        }
    }

    public function getHighInfo()
    {

        if ($this->queries === null) {
            $this->loadQueries();
            return [
                'title' => 'Primary School',
                'description' => $this->queries['high']['response'],
            ];
        } else {
            return [
                'title' => 'High School',
                'description' => '111Our high school is designed for students aged 17-18. We offer a range of subjects, including English, math, science, and social studies, as well as elective courses in areas such as business, technology, and the arts. Our high school is known for its academic rigor and preparation for university.',
            ];
        }

    }

    public function CurrentTime()
    {
        // return date('h:i:s A');
        return Carbon::now()->format('h:i:s A');
    }
    public function resetButtonStates(Chatbot $chatbot): void
    {
        // Reset the button states to their default enabled statuses
        $chatbot->primaryButtonDisabled = false;
        $chatbot->seniorButtonDisabled = false;
        $chatbot->highButtonDisabled = false;
    }

    public function clearSession(Chatbot $chatbot): void
    {
        session()->forget('chatbox-open');
        session()->forget('getMessage'); // Clear any specific session keys (if applicable)
    }
    public function disableButton(Chatbot $chatbot, $button): void
    {
        if ($button === 'primary') {
            $chatbot->primaryButtonDisabled = true;
        } elseif ($button === 'senior') {
            $chatbot->seniorButtonDisabled = true;
        } elseif ($button === 'high') {
            $chatbot->highButtonDisabled = true;
        }
        $chatbot->dispatch('start-button-timer', ['button' => $button]);
    }

}