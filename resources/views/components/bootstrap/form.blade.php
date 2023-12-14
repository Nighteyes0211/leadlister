@props(['method' => 'store'])
<form wire:submit.prevent="{{ $method }}" {{ $attributes }}>
    @csrf
    {{ $slot }}
</form>
