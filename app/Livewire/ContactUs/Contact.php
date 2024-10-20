<?php

namespace App\Livewire\ContactUs;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class Contact extends Component
{
    public $name;
    public $email;
    public $comment;
    public $success;
    public $loading = false;
    public $currentTime;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email:rfc,dns',
        'comment' => 'required|string|min:5|max:250',
    ];

    public function sendEmail()
    {
        $this->loading = true;

        $validatedData = $this->validate();

        $this->currentTime['currentTime'] = now()->format('Y-m-d H:i:s');

        try {
            Mail::send(
                'emails.email', // The view for the email content
                $validatedData,
                function ($message) {
                    $message->from('saboorhamedi49@gmail.com');
                    $message->to('saboorhamedi49@gmail.com', 'Abdul Saboor Hamedi') // Your email address
                        ->subject('New Contact Form Submission'); // Subject of the email
                }
            );

            $this->success = 'Thank you for reaching out to us!';
            $this->clearFields();
        } catch (\Exception $e) {
            $this->success = 'Sorry, there was an error sending your message. Please try again later.';
        }
        $this->loading = false;

    }

    public function updated($propertyName)
    {
        $this->success = null;
        $this->loading = false;
    }


    private function clearFields()
    {
        $this->name = '';
        $this->email = '';
        $this->comment = '';
    }

    public function render()
    {
        return view('livewire.contact-us.contact')
            ->layout('layouts.app');
    }
}
