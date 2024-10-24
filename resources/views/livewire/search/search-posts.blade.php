<div class="relative w-full bg-red-300 rounded-md">

    <div class="flex items-center justify-center">
        <input type="text" id="search" name="search" wire:model.live.debounce.750ms="query" style="width: 100%"
            class="px-4 py-2 pr-10 rounded-md " placeholder="Search posts by title...">
        <button onclick="closeResults()" class="absolute p-1 text-xs rounded-full right-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    @if (!empty($query))
        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group ">
            @if (empty($cars))
                <div id="notfound" class="flex items-center justify-between">
                    <span>No results!</span>
                </div>
            @else
                <ul id="results">
                    @foreach ($cars as $index => $car)
                        <a href="{{ route('show-profile', [$car['id']]) }}">
                            <li class="item-lists" id="select-li-{{ $index }}" data-index="{{ $index }}"
                                tabindex="0">
                                {{ $car['name'] }}
                            </li>
                        </a>
                    @endforeach
                </ul>
            @endif
        </div>
    @endif
    <script>
        function closeResults() {
            const notfound = document.querySelector('#notfound');
            const resultsContainer = document.querySelector('#results');
            const searchInput = document.querySelector('#search');

            // Clear the input value
            if (searchInput) {
                searchInput.value = '';
            }

            // Hide the notfound element if it exists
            if (notfound && notfound.parentElement) {
                notfound.parentElement.classList.add('hidden');
            }

            // Hide the results container if it exists
            if (resultsContainer) {
                resultsContainer.classList.add('hidden');
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            let currentIndex = -1;

            document.addEventListener('keydown', (e) => {
                const itemLists = document.querySelectorAll('.item-lists');
                const resultsContainer = document.querySelector('#results');

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    if (currentIndex < itemLists.length - 1) {
                        currentIndex++;
                    }
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    if (currentIndex > 0) {
                        currentIndex--;
                    }
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    if (currentIndex > -1) {
                        itemLists[currentIndex].click();
                    }
                } else if (e.key === 'Escape') {
                    e.preventDefault();
                    currentIndex = -1;
                    itemLists.forEach((item) => {
                        item.style.backgroundColor = '';
                    });
                    resultsContainer.classList.add('hidden');
                }

                itemLists.forEach((item, index) => {
                    item.style.backgroundColor = index === currentIndex ? '#ecece8' : '';
                });
            });
        });
    </script>

    <style>
        #results {
            transition: opacity 0.3s ease-in-out, visibility 0.3s ease-in-out;
            opacity: 1;
            visibility: visible;
        }

        #notfound {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 8px;
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        button {
            cursor: pointer;
            /* Pointer cursor for button */
        }

        /* Styling for the clear button */
        .clear-button {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background-color: #c13584;
            color: white;
            border: none;
            border-radius: 50%;
            width: 24px;
            /* Button width */
            height: 24px;
            /* Button height */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            /* Font size for the icon */
            transition: background-color 0.2s ease;
        }

        .clear-button:hover {
            background-color: #a5286f;
            /* Darker color on hover */
        }
    </style>
</div>
