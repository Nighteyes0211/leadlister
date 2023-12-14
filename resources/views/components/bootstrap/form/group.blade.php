@props(['col' => true, 'mb' => ''])

@php
    $colClasses = !$col ? '' : 'row'
@endphp

<div {!! $attributes->merge(['class' => "form-group align-items-center $mb $colClasses"]) !!}>
    {{ $slot }}
</div>


