<div>
    <div class="fixed z-10 bottom-4 right-4">
        <div class="flex items-center justify-end">
            <button wire:click="toggleChat" class="p-2 text-white bg-blue-500 rounded-full shadow-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org.2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m0-4h.01M5 8h14M5 12h14m-7 8h7"></path>
                </svg>
            </button>
        </div>

        <div x-data="{ isOpen: @entangle('isOpen') }" x-show="isOpen"
            class="mt-2 overflow-hidden bg-white border border-gray-200 rounded-lg shadow-lg w-80">
            <div class="p-4 text-white bg-blue-500 border-b border-gray-200">
                <h2 class="text-lg font-bold">School Chatbot</h2>
            </div>
            <div class="h-64 p-2 overflow-y-scroll" id="chat-box">
                @foreach ($messages as $message)
                    <div class="mb-1 {{ $message['user'] === 'You' ? 'bg-blue-100' : 'bg-gray-100' }} p-1 rounded">
                        <strong>{{ $message['user'] }}:</strong>
                        <div class="break-words whitespace-normal">{{ $message['text'] }}</div>
                        <span class="text-sm text-gray-500"><br>{{ $message['time'] }}</span>
                    </div>
                @endforeach
            </div>

            <div class="p-4 border-t border-gray-200">
                <div class="flex justify-center mt-4 mb-2 space-x-2">
                    <button wire:click="showPrimaryInfo"
                        class="px-3 py-1 text-white transition duration-200 bg-blue-500 rounded shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
                        {{ $this->primaryButtonDisabled ? 'disabled' : '' }}>Primary</button>
                    <button wire:click="showSeniorInfo"
                        class="px-3 py-1 text-white transition duration-200 bg-blue-500 rounded shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
                        {{ $this->seniorButtonDisabled ? 'disabled' : '' }}>Senior</button>
                    <button wire:click="showHighInfo"
                        class="px-3 py-1 text-white transition duration-200 bg-blue-500 rounded shadow hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
                        {{ $this->highButtonDisabled ? 'disabled' : '' }}>High</button>
                </div>

                <div class="flex justify-center mb-2 items-center">
                    <small class="text-[10] text-red-500">
                        @error('message')
                            {{ $message }}
                        @enderror
                    </small>
                </div>

                <input type="text" wire:model="message" wire:keydown.enter="sendMessage"
                    class="w-full p-2 border rounded @error('message') border-red-500 @enderror"
                    placeholder="Type your message...">

                {{-- <div wire:loading wire:target="sendMessage" class="p-2">Loading...</div> --}}
            </div>
        </div>

    </div>

    <script>
        const chatBox = document.getElementById('chat-box');
        // Efficient scroll handling with MutationObserver
        const observer = new MutationObserver((mutations) => {
            if (mutations[0].addedNodes.length > 0) {
                chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom after new messages
            }
        });

        observer.observe(chatBox, {
            childList: true
        });

        // Alternative scroll handling (less efficient, but more reliable)
        window.addEventListener('scroll-to-bottom', () => {
            chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom on event
        });
    </script>


</div>
