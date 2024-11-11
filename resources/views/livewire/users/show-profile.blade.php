<x-layout>

    @livewire('header')

    <section class="pt-8 pb-16 mx-auto mt-16 antialiased bg-white lg:pt-16 lg:pb-24 dark:bg-gray-900">
        <div class="flex justify-between max-w-screen-xl px-4 mx-auto ">
            <!-- Main Content Area -->
            <article
                class="w-full max-w-2xl mx-auto prose dark:prose-invert format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
                <header class="mb-4 lg:mb-6 not-format">
                    <address class="flex items-center mb-6 not-italic">
                        <div class="inline-flex items-center mr-3 text-sm text-gray-900 dark:text-white">
                            <img class="w-16 h-16 mr-4 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" alt="Jese Leos">
                            <div>
                                <a href="#" rel="author"
                                    class="ml-2 text-xl font-normal text-gray-900 dark:text-white">
                                    {{ Str::ucfirst($car->user->name) ?? '' }}
                                </a>
                                <p class="text-base text-gray-500 dark:text-gray-400">Graphic Designer, educator & CEO
                                    Flowbite</p>
                                <p class="text-base text-gray-500 dark:text-gray-400"><time pubdate
                                        datetime="2022-02-08"
                                        title="February 8th, 2022">{{ Carbon\Carbon::parse($car->created_at)->format('M d, Y') }}</time>
                                </p>
                            </div>
                        </div>
                    </address>
                </header>
                {{-- posts  --}}
                @if ($car->image)
                    <figure><img class="object-cover w-full h-auto max-h-80" src="{{ asset('storage/' . $car->image) }}"
                            alt="Car Image"></figure>
                    <figcaption class="text-center">Daily Blog by {{ Str::ucfirst($car->user->name) ?? '' }}
                    </figcaption>
                @else
                    <figure><img class="object-cover w-full h-auto max-h-80"
                            src="{{ asset('storage/default/car3.png') }}" alt="Default Car Image"></figure>
                    <figcaption class="text-center">Daily Blog by Anonymous</figcaption>
                @endif
                <x-markdown>
                    <h1 class="text-black sm:text-md md:text-lg lg:text-3xl">{!! $car->name !!}</h1>
                </x-markdown>
                <x-markdown>{!! $car->description !!}</x-markdown>
                <div class="mt-4 vote-footer">@livewire('vote.vote', ['car' => $car])</div>
            </article>
        </div>


        {{-- latest --}}
        <div class="grid gap-4 p-5 post__section sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 sm:mx-auto">
            @foreach ($latest as $car)
                <div
                    class="flex flex-col h-full overflow-hidden transition duration-300 ease-in-out transform bg-white rounded-lg shadow-md hover:shadow-lg">
                    <!-- Post image -->
                    <div class="relative h-48 bg-center bg-cover"
                        style="background-image: url('{{ $car->image ? asset('storage/' . $car->image) : asset('storage/default/car3.png') }}');">
                    </div>
                    <!-- Profile image -->
                    <div
                        class="relative w-24 h-24 mx-auto -mt-12 overflow-hidden border-4 border-white rounded-full shadow-lg">
                        @if ($car->user->profile && $car->user->profile->photo)
                            <img class="object-cover object-center w-full h-full"
                                src="{{ asset('storage/' . $car->user->profile->photo) }}" alt="Profile Image">
                        @else
                            {{-- Default profile image or SVG can go here --}}
                        @endif
                    </div>
                    <!-- User names -->
                    <div class="mt-6 text-center">
                        <h2 class="text-lg font-semibold text-gray-900">{{ ucfirst($car->user->name) }}</h2>
                        <small class="text-gray-500">{{ $car->created_at->format('Y-m-d') }}</small>
                    </div>
                    <!-- Post body -->
                    <div class="flex-grow px-6 py-4"> <!-- Make this area grow to fill space -->
                        <h2 class="mb-2 text-xl font-bold text-gray-800">
                            <a href="{{ route('show-profile', ['car' => $car->id]) }}" class="hover:underline">
                                {{ $car->name }}
                            </a>
                        </h2>
                        <div class="flex items-center mb-2 text-gray-500">
                            <span>{{ $car->year }}</span>
                        </div>
                        <div class="flex items-center mb-4 text-gray-500">
                            <svg style="color: {{ $car->color }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h .008v .008H6 .75v - .008Z" />
                            </svg>
                            <span>{{ Str::limit($car->description, 30, '...') }}</span>
                        </div>
                        <div class="flex flex-row items-center gap-2" wire:ignore>
                            @auth
                                @if ($car->user_id === Auth::id())
                                    <a href="{{ route('cars.edit', [$car->id]) }}" class="default-button" wire:ignore>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </a>
                                @endif
                            @endauth
                            <div data-url="{{ route('show-profile', ['car' => $car->id]) }}">
                                <h2>{{ $car->title }}</h2>
                                <button class="p-1 text-xs cursor-pointer default-button"
                                    onclick="copyURL('{{ route('show-profile', ['car' => $car->id]) }}', this)">
                                    <svg id="copy-icon-{{ $car->id }}" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                    </svg>
                                    <span id="copy-tooltips" style="display:none">Copy the URL to clipboard</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- Vote footer -->
                    <div class="">
                        @livewire('vote.vote', ['car' => $car])
                    </div>
                </div>
            @endforeach
        </div>


        <div class="flex justify-center mt-6 mb-6 pagination-wrapper">
            <span class="font-medium">{{ $latest->links('vendor.pagination.tailwind') }}</span>
        </div>

        {{-- end --}}
    </section>
    @livewire('footer')
</x-layout>
