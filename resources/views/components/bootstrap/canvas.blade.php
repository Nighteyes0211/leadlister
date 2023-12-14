@props(['modalId', 'closeBtnClass' => ''])
<div {!! $attributes->merge(['class' => 'offcanvas offcanvas-end']) !!} tabindex="-1" id="{{ $modalId }}" aria-modal="true" role="dialog">
    <div class="offcanvas-body">
        <button type="button" class="btn-close {{ $closeBtnClass }}" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        {{ $slot }}
    </div>
</div>
