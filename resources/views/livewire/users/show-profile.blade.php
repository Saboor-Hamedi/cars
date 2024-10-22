<x-layout>
    @livewire('header')
    <div class="mt-16 text-xl">
    </div>
    <div class="flex flex-col items-center bg-gray-50 ">
        <div class="max-w-2xl p-2 mx-auto">
            <!-- Adjusted max width to md -->
            <div class="flex flex-col">
                <p class="block text-xl font-bold leading-tight text-gray-800 md:text-2xl">
                    {!! Str::ucfirst($car->user->name) ?? '' !!}
                </p>
                <p class="text-sm text-gray-500">
                    {!! Carbon\Carbon::parse($car->created_at)->format('M d, Y') !!}
                </p>
            </div>
            <div class="mx-auto">

                @if ($car->image)
                <img class="w-full h-auto max-w-full rounded-md object-fit: cover max-h-80"
                    src="{{ asset('storage/' . $car->image) }}" alt="Car Image">
                @else
                <img class="w-full h-auto max-w-full rounded-md object-fit: cover max-h-80"
                    src="{{ asset('storage/default/car3.png') }}" alt="Car Image">
                @endif
            </div>
            <div class="w-full py-4">
                <article class="prose lg:prose-xl">
                    <x-markdown>
                        {!! $car->name !!}
                    </x-markdown>
                    <x-markdown>
                        {!! $car->description !!}
                    </x-markdown>
                </article>
            </div>
            <div class="vote-footer">@livewire('vote.vote', ['car' => $car])</div>
        </div>

    </div>
    {{-- latest --}}
    <div>
        <div class="grid gap-2 p-5 post__section sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 sm:mx-auto">
            @foreach ($latest as $car)
            <div
                class="overflow-hidden transition duration-300 ease-in-out transform bg-white rounded-lg shadow-md hover:shadow-lg">
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
                    <svg class="w-full h-full text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    @endif
                </div>
                <!-- User names -->
                <div class="mt-6 text-center">
                    <h2 class="text-lg font-semibold text-gray-900">{{ ucfirst($car->user->name) }}</h2>
                    <small class="text-gray-500">{{ $car->created_at->format('Y-m-d') }}</small>
                </div>
                <!-- Post body -->
                <div class="px-6 py-4">
                    <h2 class="mb-2 text-xl font-bold text-gray-800">
                        <a href="{{ route('show-profile', ['car' => $car->id]) }}" class="hover:underline">
                            {{ $car->name }}
                        </a>
                    </h2>
                    <div class="flex items-center mb-2 text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                        <span>{{ $car->year }}</span>
                    </div>
                    <div class="flex items-center mb-4 text-gray-500">
                        <svg style="color: {{ $car->color }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-1">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                        </svg>
                        <span>{{ Str::limit($car->description, 30, '...') }}</span>
                    </div>
                    <div class="flex flex-row items-center gap-2" wire:ignore>
                        @auth
                        <a href="{{route('cars.edit',[$car->id])}}" class="default-button" wire:ignore>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </a>
                        @endauth
                        <div data-url="{{ route('show-profile', ['car' => $car->id]) }}">
                            <h2>{{ $car->title }}</h2>
                            <button class="p-1 text-xs cursor-pointer default-button"
                                onclick="copyURL('{{ route('show-profile', ['car' => $car->id]) }}', this)">
                                <svg id="copy-icon-{{ $car->id }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
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
    </div>
    @livewire('footer')
</x-layout>