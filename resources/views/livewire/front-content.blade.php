<div>
    <div class="custom-container">
        @foreach ($cars as $car)
            <div class="card">
                <div class="p-2">
                    <div
                        class="py-2 transition-colors duration-300 border-2 border-blue-600 card-icon hover:cursor-pointer hover:border-red-400">
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
        <span class="font-medium">{{ $cars->links('vendor.pagination.tailwind') }}</span>
    </div>
</div>
