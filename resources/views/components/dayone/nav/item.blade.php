@props(['href' => '#', 'iconClass' => '', 'action' => ''])
@php
    $action = $action ? Arr::wrap($action) : ''
@endphp

@if ($action)
    @canany($action)
        <li class="slide {{ request()->url() == $href ? 'is_expanded' : '' }}">
            <a class="side-menu__item {{ request()->url() == $href ? 'active' : '' }}" href="{{ $href }}">
                <i class="sidemenu_icon {{ $iconClass }}"></i>
                <span class="side-menu__label">{{ $slot }}</span>
            </a>
        </li>
    @endcanany
@else
    <li class="slide {{ request()->url() == $href ? 'is_expanded' : '' }}">
        <a class="side-menu__item {{ request()->url() == $href ? 'active' : '' }}" href="{{ $href }}">
            <i class="sidemenu_icon {{ $iconClass }}"></i>
            <span class="side-menu__label">{{ $slot }}</span>
        </a>
    </li>
@endif
