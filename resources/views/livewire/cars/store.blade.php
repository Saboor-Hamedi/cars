<div>
    <form wire:submit.prevent="store">
        @if (session()->has('message'))
            <div class="relative px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded" role="alert">
                {{ session('message') }}
            </div>
        @endif
        <div class="mt-2">
            <input wire:model="name" name="name" id="name"
                class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-2"
                placeholder="Car name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        {{-- start color picker --}}

        <div>
            <div class="flex justify-center gap-3 mt-2 space-x-2">
                <input wire:model="color" name="color" id="color"
                    class= "w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-2"
                    type="text" placeholder="Color" />
                <input id="nativeColorPicker1" class="default-button" type="color" value="#6590D5" />

            </div>
            <x-input-error :messages="$errors->get('color')" />
        </div>

        {{-- end color picker --}}
        <div class="mt-2">
            <input wire:model="year" name="year" id="year"
                class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-2"
                placeholder="Car year" />
            <x-input-error :messages="$errors->get('year')" />
        </div>
        <div class="mt-2">
            <textarea wire:model='description' id="description" name="description" rows="3" placeholder="Description"
                class="w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 p-2"></textarea>
            <x-input-error :messages="$errors->get('description')" />
        </div>

        <button type="submit" class="default-button">
            Register
        </button>

        <div wire:loading>
            Processing...
        </div>

    </form>
</div>
