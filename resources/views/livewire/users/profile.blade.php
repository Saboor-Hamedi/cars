<div>
    {{-- @livewire('header') --}}
    <section class="relative pt-40 pb-24">
        <img src="https://pagedone.io/asset/uploads/1705473908.png" alt="cover-image"
            class="w-full absolute top-0 left-0 z-0 h-60 object-cover">
        <div class="w-full max-w-7xl mx-auto px-6 md:px-8">
            <div class="flex items-center justify-center sm:justify-start relative z-10 mb-5">
                @if ($photo)

                <img src="{{ $photo->temporaryUrl() }}"
                    class="rounded-full w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48 lg:w-40 lg:h-40 xl:w-50 xl:h-50">
                @elseif ($photoPath)

                <img src="{{ $photoPath ? asset('storage/' . $photoPath) : '' }}"
                    class="rounded-full w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48 lg:w-40 lg:h-40 xl:w-50 xl:h-50">
                @else

                <img src="https://pagedone.io/asset/uploads/1705471668.png"
                    class="rounded-full w-32 h-32 sm:w-40 sm:h-40 md:w-48 md:h-48 lg:w-40 lg:h-40 xl:w-50 xl:h-50">
                @endif
            </div>
            <div class="flex items-center justify-center flex-col sm:flex-row max-sm:gap-5 sm:justify-between mb-5">
                <div class="block">
                    <h3 class="font-manrope font-bold text-4xl text-gray-900 mb-1 max-sm:text-center">
                        {{Str::ucfirst(Auth::user()->name)}}
                    </h3>
                    <p class="font-normal text-base leading-7 text-gray-500  max-sm:text-center">Engineer at BB Agency
                        Industry <br class="hidden sm:block">New
                        York, United States</p>
                </div>
                <button
                    class="py-3.5 px-5 flex rounded-full bg-indigo-600 items-center shadow-sm shadow-transparent transition-all duration-500 hover:bg-indigo-700">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.3011 8.69881L8.17808 11.8219M8.62402 12.5906L8.79264 12.8819C10.3882 15.6378 11.1859 17.0157 12.2575 16.9066C13.3291 16.7974 13.8326 15.2869 14.8397 12.2658L16.2842 7.93214C17.2041 5.17249 17.6641 3.79266 16.9357 3.0643C16.2073 2.33594 14.8275 2.79588 12.0679 3.71577L7.73416 5.16033C4.71311 6.16735 3.20259 6.67086 3.09342 7.74246C2.98425 8.81406 4.36221 9.61183 7.11813 11.2074L7.40938 11.376C7.79182 11.5974 7.98303 11.7081 8.13747 11.8625C8.29191 12.017 8.40261 12.2082 8.62402 12.5906Z"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" />
                    </svg>
                    <span class="px-2 font-semibold text-base leading-7 text-white">Send Message</span>
                </button>
            </div>
            <div class="flex max-sm:flex-wrap max-sm:justify-center items-center gap-4">
                <a href="javascript:;"
                    class="rounded-full py-3 px-6 bg-stone-100 text-gray-700 font-semibold text-sm leading-6 transition-all duration-500 hover:bg-stone-200 hover:text-gray-900">Ux
                    Research</a>
                <a href="javascript:;"
                    class="rounded-full py-3 px-6 bg-stone-100 text-gray-700 font-semibold text-sm leading-6 transition-all duration-500 hover:bg-stone-200 hover:text-gray-900">CX
                    Strategy</a>
                <a href="javascript:;"
                    class="rounded-full py-3 px-6 bg-stone-100 text-gray-700 font-semibold text-sm leading-6 transition-all duration-500 hover:bg-stone-200 hover:text-gray-900">Project
                    Manager</a>
            </div>
        </div>
    </section>

    {{-- custom profile --}}
    <div class="px-4 py-4 mx-auto">
        <div class="max-w-md mx-auto rounded-lg shadow-md bg-white-300">
            <div class="p-4 text-gray-900">
                @if (session()->has('message'))
                <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                    {{ session('message') }}
                </div>
                @endif
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
                    <div class="custom-uploader">
                        <input type="file" wire:model="photo" id="photo" name="photo">
                        <x-input-error :messages="$errors->get('photo')" />
                    </div>
                    {{-- display photo here --}}
                    <div class="flex justify-start mt-3">
                        @if ($photo)
                        <img id="image-preview" src="{{ $photo->temporaryUrl() }}" class="custom-circle-image">
                        @else
                        <img id="image-preview" src="{{ $photoPath ? asset('storage/' . $photoPath) : '' }}"
                            class="custom-circle-image">
                        @endif
                    </div>
                    {{-- save button --}}
                    <button type="submit" class="default-button">
                        Save
                    </button>
                </form>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#birthday", {});
    </script>



</div>