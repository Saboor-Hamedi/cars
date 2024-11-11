<div>
    <div class="max-w-screen-xl p-5 mx-auto ">
        <div class="grid gap-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-3">
            @foreach ($cars as $car)
                <div wire:key="{{ $car->id }}"
                    class="overflow-hidden transition duration-300 transform bg-white rounded-lg shadow-md hover:shadow-sm ">
                    <!-- Car Image -->
                    <img src="{{ $car->image_url ?? 'https://via.placeholder.com/300x200' }}" alt="{{ $car->name }}"
                        class="object-cover w-full h-48">

                    <!-- Card Body -->
                    <div class="p-4">
                        <!-- Car Name -->
                        <h3 class="text-lg font-semibold text-gray-800">{{ $car->name }}</h3>
                        <!-- User and Posted Time -->
                        <div class="flex items-center mt-2 text-sm text-gray-500">
                            <span>Posted by {{ $car->user->profile->name ?? 'Unknown' }}</span>
                            <span class="mx-2">•</span>
                            <span>{{ $car->created_at->diffForHumans() }}</span>
                        </div>
                        <!-- Car Description -->
                        <p class="mt-3 text-gray-600">
                            {{ Str::limit($car->description, 40, '...') ?? 'No description available.' }}
                            {{-- @livewire('users.personal-post-delete', ['carId' => $car->id]) --}}
                            @livewire('users.personal-post-delete', ['carId' => $car->id], key('post-delete-' . $car->id))

                        </p>
                    </div>
                    <div>
                        {{-- @livewire('vote.vote', ['car' => $car]) --}}
                        @livewire('vote.vote', ['car' => $car], key('vote-' . $car->id))

                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination Links -->
        <div class="mt-6">
            {{ $cars->links() }}
        </div>
    </div>

</div>
