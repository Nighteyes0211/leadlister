@props(['href' => '#', 'action' => ''])

@php
    $action = Arr::wrap($action)
@endphp

@if ($action)
    @canany($action)
        <li class="{{ request()->url() == $href ? 'is-expanded' : '' }}"><a class="slide-item {{ request()->url() == $href ? 'active' : '' }}" href="{{ $href }}">{{ $slot }}</a></li>
    @endcanany
@else
    <li class="{{ request()->url() == $href ? 'is-expanded' : '' }}"><a class="slide-item {{ request()->url() == $href ? 'active' : '' }}" href="{{ $href }}">{{ $slot }}</a></li>
@endif
