<div>
    {{-- user profile --}}
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 ">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="px-4 py-4 mx-auto">
        <div class="max-w-md mx-auto overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-4 text-gray-900">
                @if (session()->has('message'))
                    <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                        {{ session('message') }}
                    </div>
                @endif
                <div>
                    <form wire:submit.prevent='update'>
                        <div class="mt-2">
                            <input wire:model='lastname' name="lastname" id="lastname"
                                class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-2"
                                placeholder="Your Lastname" />
                            <x-input-error :messages="$errors->get('lastname')" />
                        </div>
                        <div class="mt-2">
                            <input wire:model='birthday' name="birthday" id="birthday"
                                class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-2"
                                placeholder="Date of Birth" />
                            <x-input-error :messages="$errors->get('birthday')" />
                        </div>

                        {{-- start profile image --}}

                        <div class="flex flex-col col-span-full">
                            <div class="mt-3 px-3 py-2 border border-gray-300 rounded-md">
                                <input type="file" wire:model="photo" id="photo" name="photo"
                                    class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400">
                                <x-input-error :messages="$errors->get('photo')" />
                            </div>

                            <div
                                class="flex flex-col items-center justify-between px-4 py-5 mt-2 border border-dashed rounded-lg border-gray-900/25">
                                <div class="text-center">
                                    <img id="image-preview"
                                        src="{{ $photo ? asset('storage/public_pics/' . $photo) : '' }}"
                                        alt="Uploaded Image Preview" class="{{ $photo ? '' : 'hidden' }}">
                                </div>
                            </div>
                        </div>

                        {{-- end profile image --}}
                        <button type="submit" class="default-button">
                            Update
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
