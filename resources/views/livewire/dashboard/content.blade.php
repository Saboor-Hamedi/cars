<div>
    <div class="post__section">
        @foreach ($cars as $car)
            <div
                class="max-w-2xl text-gray-900 shadow-sm sm:max-w-md md:max-w-sm lg:max-w-sm xl:max-w-sm sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto">
                {{-- post image --}}
                <div class="h-32 overflow-hidden rounded-t-lg">
                    @if ($car->image)
                        <img class="object-cover object-top w-full" src="{{ asset('storage/' . $car->image) }}"
                            alt="Car Image">
                    @else
                        <img class="object-cover object-top w-full" src="{{ asset('storage/default/car3.png') }}"
                            alt="Car Image">
                    @endif
                </div>
                {{-- profile image --}}
                <div
                    class="relative w-32 h-32 mx-auto -mt-16 overflow-hidden duration-300 border-2 border-blue-600 rounded-full card-icon hover:cursor-pointer hover:border-red-400">
                    @if ($car->user->profile && $car->user->profile->photo)
                        <img class="object-cover object-center h-32 " id="image-preview"
                            src="{{ asset('storage/' . $car->user->profile->photo) }}" alt="image">
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                            <path d="M12 14l9-5-9-5-9 5 9 5z"></path>
                        </svg>
                    @endif
                </div>
                {{-- user names --}}

                <div class="mt-2 text-center">
                    <h2 class="font-semibold">{!! Str::ucfirst($car->user->name) !!}</h2>
                    <small class="text-gray-300">{{ $car->created_at->format('Y-m-d') }}</small>
                </div>

                {{-- post body --}}
                <div class="px-2 mb-2">
                    {{-- pick color --}}
                    @php
                        $color = $car->color;
                        if (preg_match('/^#?[a-fA-F0-9]{3,6}$/', $color)) {
                            if (strpos($color, '#') !== 0) {
                                $color = '#' . $color;
                            }
                        }
                    @endphp

                    <h2 class="card-title">
                        <a href="{{ route('show-profile', ['car' => $car->id]) }}">
                            {!! $car->name !!}
                        </a>
                    </h2>
                    <small class="flex items-center text-gray-300 justify-normal">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                        </svg>
                        <span class="ml-2">{{ $car->year }}</span>
                    </small>

                    <small>
                        <svg style="color: {{ $color }}" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.098 19.902a3.75 3.75 0 0 0 5.304 0l6.401-6.402M6.75 21A3.75 3.75 0 0 1 3 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 0 0 3.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008Z" />
                        </svg>
                    </small>
                    <p>
                        {!! Purifier::clean(Str::limit($car->description, 30, '...')) !!}

                    </p>
                </div>
                {{-- style="background-color: {{ $color }}" --}}
                <div class="vote-footer">@livewire('vote.vote', ['car' => $car])</div>
                {{-- end --}}
            </div>
        @endforeach
    </div>
    <div class="flex justify-center mb-6 pagination-wrapper">
        <span class="font-medium">{{ $cars->links('vendor.pagination.tailwind') }}</span>
    </div>
</div>
