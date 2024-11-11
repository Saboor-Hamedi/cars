<div>
    <article class="grid gap-4 p-5 mx-auto sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3">
        @foreach ($cars as $car)
            <div wire:key="{{ $car->id }}"
                class="overflow-hidden transition duration-300 transform bg-white rounded-lg shadow-md hover:shadow-sm">
                <!-- Car Image -->
                @if (!empty($car->image))
                    <img src="{{ asset('storage/' . $car->image) }}" class="object-cover w-full h-48">
                @else
                    <img src="{{ $car->image_url ?? 'https://via.placeholder.com/300x200' }}"
                        class="object-cover w-full h-48">
                @endif
                <!-- Card Body -->
                <div class="p-4">
                    <!-- Car Name -->
                    <h3 class="text-lg font-semibold text-gray-800">{{ $car->name }}</h3>
                    <!-- User and Posted Time -->
                    <div class="flex items-center mt-2 text-sm text-gray-500">
                        <span>Posted by {{ $car->user->name ?? 'Unknown' }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $car->created_at->diffForHumans() }}</span>
                    </div>
                    <!-- Car Description -->
                    <p class="mt-3 text-gray-600">
                        {{ Str::limit($car->description, 40, '...') ?? 'No description available.' }}
                    </p>
                </div>
                <div class="p-4">
                    @livewire('users.personal-post-delete', ['carId' => $car->id], key('post-delete-' . $car->id))
                </div>
                <div class="p-4 border-t">
                    @livewire('vote.vote', ['car' => $car], key('vote-' . $car->id))
                </div>
            </div>
        @endforeach
    </article>

    <!-- Pagination -->
    <div class="flex justify-center mt-4">
        <div class="p-2 bg-red-500 rounded">
            {{ $cars->links() }}
        </div>
    </div>
</div>
