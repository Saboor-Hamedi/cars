(function () {
    // Use a unique name for the variable to avoid collisions
    const chatBox = document.getElementById('chat-box');

    if (chatBox) {
        const observer = new MutationObserver((mutations) => {
            if (mutations[0].addedNodes.length > 0) {
                const loaderHeight = 40; // adjust this value to match the height of the loader
                chatBox.scrollTop = chatBox.scrollHeight - loaderHeight; // Scroll to bottom after new messages
            }
        });

        observer.observe(chatBox, {
            childList: true
        });

        document.addEventListener('livewire:load', function () {
            Livewire.hook('message.processed', () => {
                const loaderHeight = 40; // adjust this value to match the height of the loader
                chatBox.scrollTop = chatBox.scrollHeight - loaderHeight; // Scroll to bottom after new messages
            });
        });
    } else {
        console.warn("Chat box not found.");
    }
})();