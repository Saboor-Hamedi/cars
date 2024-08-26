<div>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 ">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    <div class="px-4 py-4 mx-auto">
        {{-- max-w-md --}}
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

                        <button type="submit" class="default-button">
                            Update
                        </button>

                        <div wire:loading>
                            Processing...
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
