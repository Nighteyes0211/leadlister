@props(['col' => true])


@php
    $colClasses = !$col ? '' : 'row'
@endphp

<div {!! $attributes->merge(['class' => "form-check align-items-center $colClasses"]) !!}>
    {{ $slot }}
</div>


