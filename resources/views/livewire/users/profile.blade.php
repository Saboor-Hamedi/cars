<div>
    @livewire('users.profile-header')
    {{-- end tabs --}}
    <section class="relative pt-40 pb-24">
        <div style="background-color: {{ $bgColor ?? '#000000' }};"
            class="absolute top-0 left-0 z-0 object-cover w-full h-60">
        </div>

        <div class="w-full px-6 mx-auto max-w-7xl md:px-8">

            <div
                class="relative z-10 flex items-center justify-center p-2 mb-5 transition duration-300 ease-in-out transform bg-white rounded-md shadow-md hover:shadow-sm sm:justify-start">
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

                @livewire('bg-color.background-color')
            </div>

            <div class="flex flex-col items-center justify-center mb-5 sm:flex-row max-sm:gap-5 sm:justify-between">
                <div class="block">
                    <h3 class="mb-1 font-bold text-gray-900 lg:text-4xl md:text-lg sm:text-sm font-manrope ">
                        {{ Str::ucfirst(Auth::user()->name) }}
                        {{ $lastname }}
                    </h3>
                    <p class="text-base font-normal leading-7 text-gray-500 max-sm:text-center">
                        Engineer at BB Agency
                        Industry <br class="hidden sm:block">New
                        York, United States</p>
                </div>

                <button
                    class="py-3.5 px-5 flex rounded-full bg-indigo-600 items-center shadow-sm shadow-transparent transition-all duration-500 hover:bg-indigo-700">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M11.3011 8.69881L8.17808 11.8219M8.62402 12.5906L8.79264 12.8819C10.3882 15.6378 11.1859 17.0157 12.2575 16.9066C13.3291 16.7974 13.8326 15.2869 14.8397 12.2658L16.2842 7.93214C17.2041 5.17249 17.6641 3.79266 16.9357 3.0643C16.2073 2.33594 14.8275 2.79588 12.0679 3.71577L7.73416 5.16033C4.71311 6.16735 3.20259 6.67086 3.09342 7.74246C2.98425 8.81406 4.36221 9.61183 7.11813 11.2074L7.40938 11.376C7.79182 11.5974 7.98303 11.7081 8.13747 11.8625C8.29191 12.017 8.40261 12.2082 8.62402 12.5906Z"
                            stroke="white" stroke-width="1.6" stroke-linecap="round" />
                    </svg>
                    <span class="px-2 text-base font-semibold leading-7 text-white">Send Message</span>
                </button>
            </div>
            <div class="flex items-center gap-4 max-sm:flex-wrap max-sm:justify-center">
                <a href="javascript:;"
                    class="px-6 py-3 text-sm font-semibold leading-6 text-gray-700 transition-all duration-500 rounded-full bg-stone-100 hover:bg-stone-200 hover:text-gray-900">
                    UI x
                </a>
                <a href="javascript:;"
                    class="px-6 py-3 text-sm font-semibold leading-6 text-gray-700 transition-all duration-500 rounded-full bg-stone-100 hover:bg-stone-200 hover:text-gray-900">CX
                    Strategy</a>
                <a href="javascript:;"
                    class="px-6 py-3 text-sm font-semibold leading-6 text-gray-700 transition-all duration-500 rounded-full bg-stone-100 hover:bg-stone-200 hover:text-gray-900">Project
                    Manager</a>
            </div>
        </div>
    </section>
    {{-- Show posts --}}
    @livewire('users.personal-posts')
</div>
