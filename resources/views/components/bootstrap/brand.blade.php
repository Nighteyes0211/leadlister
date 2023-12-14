@props(['logo' => asset('images/logo.png') ])
<img src="{{ $logo }}" alt="logo" {!! $attributes->merge(['class' => 'shadow-light object-fit-contain']) !!} width="150px">

