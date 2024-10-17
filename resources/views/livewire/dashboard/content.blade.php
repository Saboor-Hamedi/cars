<div>
    <div class="grid gap-2 p-5 post__section sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($cars as $car)
        <div
            class="overflow-hidden transition duration-300 ease-in-out transform bg-white rounded-lg shadow-lg hover:-translate-y-1 hover:shadow-2xl">
            <!-- Post image -->
            <div class="relative h-48 bg-center bg-cover"
                style="background-image: url('{{ $car->image ? asset('storage/' . $car->image) : asset('storage/default/car3.png') }}');">
            </div>
            <!-- Profile image -->
            <div class="relative w-24 h-24 mx-auto -mt-12 overflow-hidden border-4 border-white rounded-full shadow-lg">
                @if ($car->user->profile && $car->user->profile->photo)
                <img class="object-cover object-center w-full h-full"
                    src="{{ asset('storage/' . $car->user->profile->photo) }}" alt="Profile Image">
                @else
                <svg class="w-full h-full text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
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
                <div wire:ignore>
                    @auth
                    <button class="default-button" wire:click.prevent="toEdit({{$car->id}})">Edit</button>
                    @endauth
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
        <span class="font-medium">{{ $cars->links('vendor.pagination.tailwind') }}</span>
    </div>

</div>