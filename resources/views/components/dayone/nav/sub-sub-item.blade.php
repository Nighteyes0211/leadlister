@props(['href' => '#', 'action' => ''])

@php
    $action = Arr::wrap($action)
@endphp

@if ($action)
    @canany($action)
        <li><a class="sub-slide-item {{ request()->url() == $href ? 'active' : '' }}" href="{{ $href }}">{{ $slot }}</a></li>
    @endcanany
@else
    <li><a class="sub-slide-item {{ request()->url() == $href ? 'active' : '' }}" href="{{ $href }}">{{ $slot }}</a></li>
@endif
