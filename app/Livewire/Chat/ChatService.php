<?php
namespace App\Livewire\Chat;

use Carbon\Carbon;
use Livewire\Component;
class ChatService extends Component
{

    protected $primaryButtonDisabled = false;
    protected $seniorButtonDisabled = false;
    protected $highButtonDisabled = false;
    public $messages = [];
    public $message;


    public function cantAnswer()
    {
        return "I'm not sure how to answer that, but I'm here to help! 🤔 Please ask about the school, and I'll do my best to assist you.";
    }
    public function getPrimaryInfo()
    {
        return [
            'title' => 'Primary School',
            'description' => 'Our primary school is designed for students aged 5-11. We offer a comprehensive curriculum that includes English, math, science, and social studies. Our primary school is known for its small class sizes and experienced teachers.',
        ];
    }

    public function getSeniorInfo()
    {
        return [
            'title' => 'Senior School',
            'description' => 'Our senior school is designed for students aged 12-16. We offer a wide range of subjects, including English, math, science, and social studies, as well as elective courses in areas such as music, art, and drama. Our senior school is known for its academic excellence and supportive community.',
        ];
    }

    public function getHighInfo()
    {
        return [
            'title' => 'High School',
            'description' => 'Our high school is designed for students aged 17-18. We offer a range of subjects, including English, math, science, and social studies, as well as elective courses in areas such as business, technology, and the arts. Our high school is known for its academic rigor and preparation for university.',
        ];
    }

    public function CurrentTime()
    {
        // return date('h:i:s A');
        return Carbon::now()->format('h:i:s A');
    }

}