<div>
    <section class="p-2 h-max">

        <div class="max-w-screen-md mx-auto mt-20">
            @if ($success)
            <div class="inline-flex w-full overflow-hidden bg-white rounded-lg shadow-sm">
                <div class="flex items-center justify-center w-12 bg-[#c13584]">
                </div>
                <div class="text-left ">
                    <span class="ml-1 font-semibold text-[#c13584]">Success</span>
                    <p class="mb-1 ml-1 text-sm leading-none text-gray-500">{{ $success }} </p>
                </div>
            </div>
            @endif
            <form wire:submit.prevent='sendEmail' class="space-y-2">
                {{-- your name --}}

                <input wire:model='name' type="text" id="name"
                    class="block w-full p-3 text-sm text-gray-900 border border-gray-300 rounded-lg shadow-sm bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                    placeholder="Your full name">
                @error('name')
                <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
                {{-- your email --}}

                <input wire:model='email' type="email" id="email"
                    class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                    placeholder="example@email.com">
                @error('email')
                <small class="text-sm text-red-500">{{ $message }}</small>
                @enderror
                {{-- your comment --}}
                <div class="sm:col-span-2">

                    <textarea wire:model='comment' id="comment" rows="6"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg shadow-sm border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                        placeholder="Leave an email..."></textarea>
                    @error('comment')
                    <small class="text-sm text-red-500 ">{{ $message }}</small>
                    @enderror
                </div>
                {{-- <x-primary-button type="submit" class="outline-none ring-inherit ring-0">
                    Send
                </x-primary-button> --}}

                <div class="flex items-center">
                    <x-primary-button type="submit" class="outline-none ring-inherit ring-0"
                        wire:loading.attr="disabled">
                        <span wire:loading.remove>Send</span>
                        <span wire:loading>Loading...</span>
                    </x-primary-button>
                </div>
            </form>
        </div>
    </section>
    @livewire('footer')
</div>