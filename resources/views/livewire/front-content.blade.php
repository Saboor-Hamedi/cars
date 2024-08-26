<div>
    <div class="custom-container">
        @foreach ($cars as $car)
            <div class="card">
                <div class="card-icon" style="background-color: #00BCD4;">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                        <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    </svg>
                </div>
                <h2 class="card-title">{!! $car->name !!}</h2>
                <p class="card-description">
                    <span class="font-bold">Year:</span> {{ $car->year }}<br>
                    <span class="font-bold">Date</span> {{ $car->created_at->format('Y-m-d') }}<br>
                    <span class="font-bold">User:</span> {!! Str::ucfirst($car->user->name)!!}<br>
                    <span class="font-bold">Description:</span> {!! Str::limit($car->description, 30, '...')!!}
                </p>
            </div>
        @endforeach
    </div>
    <div class="flex justify-center mt-6 pagination-wrapper">
        <span class="font-medium">{{ $cars->links('vendor.pagination.tailwind') }}</span>
    </div>
</div>
