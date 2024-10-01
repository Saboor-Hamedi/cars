<x-layout>
    @livewire('header')
    <div class="text-xl mt-2"></div>
    <div class="flex flex-col items-center bg-gray-50">
        <div class="p-2 max-w-2xl mx-auto"> <!-- Adjusted max width to md -->
            <div class="flex flex-col">
                <p class="block text-xl md:text-2xl font-bold leading-tight text-gray-800">
                    {!! Str::ucfirst($car->user->name) ?? '' !!}
                </p>
                <p class="text-sm text-gray-500">
                    {!! Carbon\Carbon::parse($car->created_at)->format('M d, Y') !!}
                </p>
            </div>
            <div class="mx-auto">
                @if ($car->user->profile && $car->user->profile->photo)
                    <div class="flex justify-start">
                        <img id="image-preview" src="{{ asset('storage/' . $car->user->profile->photo) }}" alt="image"
                            class="w-full h-auto object-fit: cover max-w-full max-h-80">
                    </div>
                @else
                    <div class="flex justify-start">
                        <img id="image-preview" src="{{ asset('./storage/default/car3.png') }}" alt=" image"
                            class="w-full h-auto object-fit: cover max-w-full max-h-80">
                    </div>
                @endif
            </div>
            <div class="w-full py-4">
                <p class="block text-xl md:text-2xl font-bold leading-tight text-gray-800 hover:text-blue-500">
                    {!! $car->name !!}
                </p>
                <p class="mt-2 text-sm md:text-base">
                    {!! $car->description !!}
                </p>
            </div>
            <div class="vote-footer">@livewire('vote.vote', ['car' => $car])</div>
        </div>

    </div>
    {{-- latest --}}
    <div class="custom-container p-10">
        @foreach ($latest as $car)
            <div class="card">
                <div class="p-2">
                    <div
                        class="p-3 transition-colors duration-300 border-2 border-blue-600 card-icon hover:cursor-pointer hover:border-red-400">
                        @if ($car->user->profile && $car->user->profile->photo)
                            <div class="flex justify-start">
                                <img id="image-preview" src="{{ asset('storage/' . $car->user->profile->photo) }}"
                                    alt="{{ $car->name }} image" class="object-fill custom-circle-image">
                            </div>
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                                <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                            </svg>
                        @endif
                    </div>

                    <h2 class="card-title">
                        <a href="{{ route('show-profile', ['car' => $car->id]) }}">
                            {!! $car->name !!}
                        </a>

                    </h2>
                    @php
                        $color = $car->color;
                        if (strpos($color, '#') !== 0) {
                            $color = '#' . $color;
                        }
                    @endphp
                    <span class="font-bold">Year:</span> {{ $car->year }}<br>
                    <div class="cars-color"> Color:
                        <span style="background-color: {{ $car->color }}; " class="inner-car-color"></span>
                    </div>
                    <span class="font-bold">Date</span> {{ $car->created_at->format('Y-m-d') }}<br>
                    <span class="font-bold">User:</span> {!! Str::ucfirst($car->user->name) !!}<br>
                    <span class="font-bold">Description:</span> {!! Str::limit($car->description, 30, '...') !!}
                </div>
                <div class="vote-footer">@livewire('vote.vote', ['car' => $car])</div>
            </div>
        @endforeach
    </div>

    <div class="flex justify-center mt-6 pagination-wrapper">
        <span class="font-medium">{{ $latest->links('vendor.pagination.tailwind') }}</span>
    </div>

</x-layout>
