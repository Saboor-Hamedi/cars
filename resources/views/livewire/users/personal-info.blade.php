<div>
    @livewire('users.profile-header')
    <div class="p-4 mt-20">
        <div class="overflow-hidden bg-white rounded-md shadow-md ">
            <div class="p-6 text-gray-900 transition ease-in-out transform duration-900">

                <form wire:submit.prevent='update'>
                    <div class="mb-4">
                        <input wire:model='lastname' name="lastname" id="lastname"
                            class="w-full px-3 py-2 mt-1 text-gray-900 border rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                            placeholder="Your Lastname" />
                        <x-input-error :messages="$errors->get('lastname')" />
                    </div>

                    <div class="mb-4" wire:ignore>
                        <input wire:model='birthday' name="birthday" id="birthday"
                            class="w-full px-3 py-2 mt-1 text-gray-900 border rounded-md shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm"
                            placeholder="Select your Date of Birth" />
                        <x-input-error :messages="$errors->get('birthday')" />
                    </div>

                    {{-- Profile image uploader --}}
                    <div class="mb-4">
                        <input type="file" wire:model="photo" id="photo" name="photo"
                            class="block w-full mt-1 text-sm text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                        <x-input-error :messages="$errors->get('photo')" />
                    </div>

                    {{-- Display photo here --}}
                    <div class="flex flex-row-reverse items-center justify-between px-1 mt-3 rounded-md ">
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}"
                                class="w-32 h-32 rounded-full sm:w-40 sm:h-40 md:w-48 md:h-48 lg:w-40 lg:h-40 xl:w-50 xl:h-50">
                        @elseif ($photoPath)
                            <img src="{{ $photoPath ? asset('storage/' . $photoPath) : '' }}"
                                class="w-32 h-32 rounded-full sm:w-40 sm:h-40 md:w-48 md:h-48 lg:w-40 lg:h-40 xl:w-50 xl:h-50">
                        @else
                            <img src="https://pagedone.io/asset/uploads/1705471668.png"
                                class="w-32 h-32 rounded-full sm:w-40 sm:h-40 md:w-48 md:h-48 lg:w-40 lg:h-40 xl:w-50 xl:h-50">
                        @endif
                        {{-- Save button --}}

                        <div class="mt-6">
                            <button type="submit"
                                class=" py-2 px-4 bg-[#c13584] text-white rounded-md hover:bg-[#a12d73] transition duration-200 focus:outline-none focus:ring-2 focus:ring-[#c13584] focus:ring-opacity-50">
                                Save
                            </button>
                            @if (session()->has('message'))
                                <div class="inline-flex text-xs text-gray-400" id="profileBox">
                                    {{ session('message') }}
                                    <svg class="w-4 h-4 ml-1 text-gray-400 cursor-pointer"
                                        onclick="closeProfileMessage()" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </div>
                            @endif
                        </div>

                        <script>
                            function closeProfileMessage() {
                                const profileBox = document.getElementById('profileBox');
                                profileBox.classList.remove('opacity-20');
                                profileBox.classList.add('opacity-0');
                                setTimeout(() => {
                                    profileBox.style.display = 'none';
                                }, 500);
                            }
                        </script>
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
                dateFormat: "Y-m-d",
                allowInput: true, // Allow manual input
                onReady: function(selectedDates, dateStr, instance) {
                    instance.input.setAttribute('aria-label', 'Date of Birth');
                }
            });
        });
    </script>
</div>
