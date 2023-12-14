@props([ 'color' => 'primary', 'size' => 'lg', 'text'])

<div class="dropdown">
    <button {!! $attributes->merge(['class' => "btn btn-{$color} btn-{$size} dropdown-toggle", 'type' => 'button', 'data-toggle' => 'dropdown', 'aria-expanded' => false]) !!} >
        {{ $text }}
    </button>
    <div class="dropdown-menu">
        {{ $slot }}
    </div>
</div>
