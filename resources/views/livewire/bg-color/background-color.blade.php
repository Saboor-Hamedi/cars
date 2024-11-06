<div>
    <div id="bgColor" class="absolute right-0 flex flex-row-reverse items-center gap-3 p-3 ">
        <!-- Color picker circle -->
        <div id="color-picker-circle" class="rounded-full cursor-pointer w-7 h-7"
            style="background-color: {{ $backgroundColor }};"
            onclick="document.getElementById('background-color').click()">
        </div>
        <input type="color" id="background-color" wire:model.lazy="backgroundColor"
            class="absolute right-0 w-0 h-0 mr-16 opacity-0" onchange="updateCircleColorAndSave(this.value)">
        <div wire:loading.delay>
            Loading...
        </div>

    </div>
    <script>
        function updateCircleColorAndSave(color) {
            document.getElementById('color-picker-circle').style.backgroundColor = color;
            @this.set('backgroundColor', color); // Update the Livewire property
            @this.saveBackgroundColor(); // Call the Livewire method to save the color
        }
    </script>
</div>
