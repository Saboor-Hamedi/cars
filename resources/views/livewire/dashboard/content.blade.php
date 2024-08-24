<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div>
                    <div class="flex flex-wrap justify-center mb-4">
                        @foreach ($cars as $car)
                            <div class="w-full p-4 xl:w-1/5 lg:w-1/4 md:w-1/2 sm:w-full">
                                <div class="p-4 transition duration-300 bg-white rounded shadow-md hover:shadow-lg">
                                    <h5 class="mb-2 text-lg font-bold">{{ $car->year }}</h5>
                                    <p class="text-gray-600">Owned by: {{ $car->user->name }}</p>
                                </div>
                            </div>
                        @endforeach
                    {{-- {{dd($cars->links())}} --}}
                    <div class="pagination-wrapper">
                        <span class="font-medium">{{ $cars->links('vendor.pagination.tailwind') }}</span>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
