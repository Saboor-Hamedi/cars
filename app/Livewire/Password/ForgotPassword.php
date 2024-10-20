<?php

namespace App\Livewire\Password;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\PasswordResetMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class ForgotPassword extends Component
{
    public $email;
    public $verification_code;
    public $new_password;
    public $new_password_confirmation;
    public $code_sent = false;
    public $code_expiration;
    public $generated_code;
    public $verification_success = false;
    public $code_expired = false;



    public function sendVerificationCode()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $this->generated_code = random_int(100000, 999999);
        $this->code_expiration = Carbon::now()->addMinutes(10);
        $this->code_expired = false;

        Mail::to($this->email)->send(new PasswordResetMail($this->generated_code));

        $this->code_sent = true;
        session()->flash('message', 'Verification code sent to your email.');
    }

    public function verifyCode()
    {
        $this->validate(['verification_code' => 'required|numeric']);

        // if ($this->verification_code == $this->generated_code && Carbon::now()->lessThanOrEqualTo($this->code_expiration)) {
        //     session()->flash('message', 'Verification code is valid. You can now reset your password.');
        //     $this->verification_success = true;
        // } else {
        //     session()->flash('error', 'Invalid or expired verification code. Please try again.');
        // }

        if (Carbon::now()->greaterThan($this->code_expiration)) {
            $this->code_expired = true;
            session()->flash('error', 'Verification code has expired. Please request a new code.');
            return;
        }

        if ($this->verification_code == $this->generated_code) {
            session()->flash('message', 'Verification code is valid. You can now reset your password.');
            $this->verification_success = true;
        } else {
            session()->flash('error', 'Invalid verification code. Please try again.');
        }
    }

    public function resetPassword()
    {
        $this->validate([
            'new_password' => 'required|min:8|confirmed',
        ]);

        $user = User::where('email', $this->email)->first();
        $user->password = Hash::make($this->new_password);
        $user->save();

        session()->flash('message', 'Password has been reset successfully.');
        return redirect()->to('/login');
    }
    public function resetVerification()
    {
        $this->code_sent = false;
        $this->verification_code = null;
        $this->generated_code = null;
        $this->verification_success = false;
    }
    public function render()
    {
        return view('livewire.password.forgot-password')->layout('components.layout');
    }
}
