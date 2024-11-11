<div>
    <div>
        <button class="default-button" wire:click="delete" wire:loading.attr="disabled"
            wire:loading.class="opacity-50 cursor-not-allowed" wire:confirm="Are you sure you want to delete this post?"
            @if ($isDelete) disabled @endif>
            <span wire:loading.remove>Deleting</span>
            <span wire:loading>Deleting...</span>
    </div>
</div>
