@props(['target' => ''])
<span class="spinner-border" role="status" wire:loading {{ $target ? "wire:target=$target" : '' }}> <span
    class="sr-only">Loading...</span>
</span>
