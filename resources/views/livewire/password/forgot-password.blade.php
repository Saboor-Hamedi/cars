<div class="flex items-center justify-center min-h-screen bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded shadow-md">
        @if (session()->has('message'))
        <div class="mb-4 text-green-600">{{ session('message') }}</div>
        @endif

        @if (session()->has('error'))
        <div class="mb-4 text-red-600">{{ session('error') }}</div>
        @endif

        @if (!$code_sent)
        <!-- Form to send verification code -->
        <form wire:submit.prevent="sendVerificationCode" class="space-y-4">
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" wire:model="email" id="email"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Enter your email" required>
                <x-input-error wire:ignore :messages="$errors->get('email')" />

            </div>
            {{-- <div class="mt-3">
                <x-primary-button class="bg-[#c13584]">
                    {{ __('Send Verification Code') }}
                </x-primary-button>
            </div> --}}
            <div class="flex items-center">
                <x-primary-button type="submit" class="bg-[#c13584]" wire:loading.attr="disabled">
                    <span wire:loading.remove>{{ __('Send Verification Code') }}</span>
                    <span wire:loading>{{__('Loading...')}}</span>
                </x-primary-button>
            </div>
        </form>
        @elseif (!$verification_success)
        <!-- Form to verify the code -->
        <div x-data="{ timer: 60, interval: null, isCodeExpired: @entangle('code_expired').defer }" x-init="
    interval = setInterval(() => {
        if (timer > 0) {
            timer--;
        } else {
            isCodeExpired = true; // Set the Livewire property
            clearInterval(interval);
        }
    }, 1000);
">
            <form wire:submit.prevent="verifyCode" class="mt-6 space-y-4">
                <div>
                    <label for="verification_code" class="block text-sm font-medium text-gray-700">Verification
                        Code</label>
                    <input type="text" wire:model="verification_code" id="verification_code"
                        class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Enter verification code" required>
                </div>
                <div x-show="!isCodeExpired">
                    <span class="text-sm text-gray-600">Code expires in <span x-text="timer"></span> seconds.</span>
                </div>
                <div x-show="isCodeExpired">
                    <span class="text-sm text-red-600">Code expired. </span>
                    <button type="button" wire:click="sendVerificationCode" x-on:click="
                    timer = 60;
                    isCodeExpired = false; // Reset the expired state
                    clearInterval(interval); // Clear previous interval
                    interval = setInterval(() => {
                        if (timer > 0) {
                            timer--;
                        } else {
                            isCodeExpired = true;
                            clearInterval(interval);
                        }
                    }, 1000);
                " class="text-sm text-blue-600">Resend?</button>
                </div>
                <div>
                    <button type="submit"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        :disabled="isCodeExpired">
                        Verify Code
                    </button>
                </div>
            </form>
        </div>
        @else
        <!-- Form to reset password -->
        <form wire:submit.prevent="resetPassword" class="mt-6 space-y-6">
            <div>
                <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" wire:model="new_password" id="new_password"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="New Password" required>
                <x-input-error wire:ignore :messages="$errors->get('new_password')" />
            </div>
            <div>
                <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New
                    Password</label>
                <input type="password" wire:model="new_password_confirmation" id="new_password_confirmation"
                    class="block w-full px-3 py-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    placeholder="Confirm New Password" required>
                <x-input-error wire:ignore :messages="$errors->get('new_password_confirmation')" />

            </div>
            <div>
                <button type="submit"
                    class="w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Reset Password
                </button>
            </div>
        </form>
        @endif
    </div>
</div>