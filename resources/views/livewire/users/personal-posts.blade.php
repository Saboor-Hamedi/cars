<div>
    <div class="max-w-screen-xl p-5 mx-auto ">
        <div class="grid gap-3 lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-3">
            @foreach ($cars as $car)
                <div
                    class="overflow-hidden transition duration-300 transform bg-white rounded-lg shadow-md hover:scale-105">
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
                            {{ Str::limit($car->description, 40, '...') ?? 'No description available.' }}</p>
                        <div class="flex items-center justify-between mt-4">
                            {{-- <span class="font-semibold text-gray-700">{{ $car->voteCount() }} Likes</span>
                    <button class="font-semibold text-blue-600 hover:text-blue-800">Like</button> --}}
                        </div>
                    </div>
                    <div>
                        @livewire('vote.vote', ['car' => $car])
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
