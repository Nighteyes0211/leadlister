@props(['color' => 'primary'])
<div {!! $attributes->merge(['class' => "card card-$color"]) !!}>
    @if (isset($header))
        <div class="card-header">
            {{ $header }}
        </div>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
