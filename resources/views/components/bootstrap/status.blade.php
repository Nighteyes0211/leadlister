@props(['type' => 'primary'])
<div {!! $attributes->merge(['class' => "badge badge-$type d-inline-flex align-items-center"]) !!}> <span>{{ $slot }}</span> </div>
