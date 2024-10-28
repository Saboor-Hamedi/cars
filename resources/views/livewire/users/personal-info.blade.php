<div class="container mx-auto p-4 ">
    @livewire('users.profile-header')
    <div class="mt-4">
        <div class="max-w-lg mx-auto rounded-lg shadow-lg bg-white overflow-hidden ">
            <div class="p-6 text-gray-900 transition duration-900 transform ease-in-out">

                @if (session()->has('message'))
                    <div id="alert-box" class=" inline-flex w-full overflow-hidden bg-white rounded-lg shadow-sm">
                        <div class="flex items-center justify-center w-12 bg-[#c13584]">
                            <x-bytesize-close style="width: 15px; cursor: pointer; color:white;" onclick="closeAlert()" />
                        </div>
                        <div class="text-left ">
                            <span class="ml-1 font-semibold text-[#c13584]">Success</span>
                            <p class="mb-1 ml-1 text-sm leading-none text-gray-500">{{ session('message') }}</p>
                        </div>
                    </div>
                @endif
                <script>
                    function closeAlert() {
                        const alertBox = document.getElementById('alert-box');
                        alertBox.classList.remove('opacity-20');
                        alertBox.classList.add('opacity-0');
                        // Remove the alert box from the DOM after the transition
                        setTimeout(() => {
                            alertBox.style.display = 'none';
                        }, 500); // Match this timeout to the transition duration
                    }
                </script>
                <form wire:submit.prevent='update'>
                    <div class="mb-4">
                        <input wire:model='lastname' name="lastname" id="lastname"
                            class="w-full mt-1 rounded-md border py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                            placeholder="Your Lastname" />
                        <x-input-error :messages="$errors->get('lastname')" />
                    </div>

                    <div class="mb-4" wire:ignore>
                        <input wire:model='birthday' name="birthday" id="birthday"
                            class="w-full mt-1 rounded-md border py-2 px-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                            placeholder="Select your Date of Birth" />
                        <x-input-error :messages="$errors->get('birthday')" />
                    </div>

                    {{-- Profile image uploader --}}
                    <div class="mb-4">
                        <input type="file" wire:model="photo" id="photo" name="photo"
                            class="mt-1 block w-full text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                        <x-input-error :messages="$errors->get('photo')" />
                    </div>

                    {{-- Display photo here --}}
                    <div class="flex justify-center mt-3">
                        @if ($photo)
                            <img id="image-preview" src="{{ $photo->temporaryUrl() }}"
                                class="w-32 h-32 rounded-full object-cover border-2 border-gray-300 shadow-md"
                                alt="Profile Image">
                        @else
                            <img id="image-preview" src="{{ $photoPath ? asset('storage/' . $photoPath) : '' }}"
                                class="w-32 h-32 rounded-full object-cover border-2 border-gray-300 shadow-md"
                                alt="Profile Image">
                        @endif
                    </div>

                    {{-- Save button --}}
                    <div class="mt-6">
                        <button type="submit"
                            class="w-full py-2 px-4 bg-[#c13584] text-white rounded-md hover:bg-[#a12d73] transition duration-200 focus:outline-none focus:ring-2 focus:ring-[#c13584] focus:ring-opacity-50">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#birthday", {
                dateFormat: "Y-m-d", // Customize the date format as needed
                allowInput: true, // Allow manual input
                onReady: function(selectedDates, dateStr, instance) {
                    instance.input.setAttribute('aria-label', 'Date of Birth');
                }
            });
        });
    </script>
</div>
