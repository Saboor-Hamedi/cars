<div>
    {{-- Users can change password after logged in --}}
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
            @if (session()->has('message'))
            <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                {{ session('message') }}
            </div>
            @endif
            <form wire:submit.prevent="changePassword" class="space-y-5">
                <div class="mt-3">
                    <label for="current_password" class="block text-sm font-medium text-gray-700">Current
                        Password</label>
                    <input type="password" wire:model="current_password" id="current_password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Current Password">

                    <x-input-error wire:ignore :messages="$errors->get('current_password')" />
                </div>
                <div class="mt-3">
                    <label for="new_password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" wire:model="new_password" id="new_password"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="New Password">
                    <x-input-error wire:ignore :messages="$errors->get('new_password')" />
                </div>
                <div class="mt-3">
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">Confirm
                        New
                        Password</label>
                    <input type="password" wire:model="new_password_confirmation" id="new_password_confirmation"
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="Confirm New Password">
                    <x-input-error wire:ignore :messages="$errors->get('new_password_confirmation')" />
                </div>
                <div class="mt-3">
                    <x-primary-button type="submit" class="bg-[#c13584]">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="1 2 24 24" stroke-width="1"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 10.5V6.75a4.5 4.5 0 1 1 9 0v3.75M3.75 21.75h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H3.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                        {{ __('Change Password') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>