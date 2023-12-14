@props(['direction' => 'horizontal'])
<div class="btn-group btn-group-{{ $direction }}">
    {{ $slot }}
</div>
