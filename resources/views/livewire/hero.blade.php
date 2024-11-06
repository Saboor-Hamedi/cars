    <div class="relative py-10">
        <div class="flex items-center justify-center mx-auto lg:w-5/6" style="width: 50%">
            @livewire('search.search-posts')
        </div>
        <!-- Hero Section -->
        <div class="flex items-center justify-center w-full p-4 mx-auto mt-2 rounded-md lg:w-5/6 lg:p-8">
            <div
                class="flex flex-col items-center justify-center w-full p-8 space-y-8 rounded-lg shadow-lg bg-gray-50 lg:flex-row lg:space-y-0 lg:space-x-8">
                <div class="max-w-lg text-center lg:text-left lg:max-w-md">
                    <h1 class="text-3xl font-bold text-gray-800 sm:text-4xl md:text-5xl">
                        <span class="text-blue-500">Welcome</span> to my Web Development Portfolio!
                    </h1>
                    <p class="mt-4 text-sm text-gray-700 sm:text-base md:text-lg">
                        I'm Lily Smith, a passionate web developer based in the USA. Here, you'll get a glimpse of my
                        journey in the world of web development, where creativity meets functionality.
                    </p>
                    <div class="mt-6">
                        <label for="email" class="block text-sm font-medium text-gray-700">Your email</label>
                        <div class="flex flex-col mt-1 sm:flex-row">
                            <input type="email" name="email" id="email"
                                class="flex-1 w-full px-3 py-2 mb-2 placeholder-gray-400 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500 sm:w-auto sm:mb-0 sm:mr-3"
                                placeholder="Enter your email">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#c13584] border border-transparent shadow-sm rounded-r-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                REQUIRE OFFER
                            </button>
                        </div>
                        <p class="mt-2 text-xs text-gray-500 sm:text-sm">Read my <a href="#"
                                class="font-medium text-gray-700 hover:text-gray-900">Terms and Conditions</a></p>
                    </div>
                </div>
                <div class="flex-shrink-0 px-4">
                    <img src="storage/default/saboor.jpg" alt="image not found"
                        class="object-cover w-64 h-64 rounded-md shadow-md sm:w-80 sm:h-80 md:w-96 md:h-96">
                </div>
            </div>
        </div>
    </div>
