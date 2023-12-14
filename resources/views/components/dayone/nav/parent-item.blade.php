@props(['hrefs' => [], 'iconClass' => '', 'label'])


@php

    $expandClass = '';
    $active = false;

    foreach ($hrefs as $href) {

        if ( request()->routeIs($href) )
        {
            $expandClass = 'is-expanded';
            $active = true;
            break;
        }
    }

@endphp

@if ($slot->isNotEmpty())
    <li class="slide {{ $expandClass }} ">
        <a href="#" data-bs-toggle="slide" class="side-menu__item {{ $active ? 'active is-expanded' : '' }}">
            <i class="sidemenu_icon {{ $iconClass }}"></i>
            <span class="side-menu__label">{{ $label }}</span>
            <i class="angle fa fa-angle-right"></i>
        </a>
        <ul class="slide-menu {{ $active ? 'open' : '' }}">
            <li class="side-menu-label1"><a href="#">{{ $label }}</a></li>

            {{ $slot }}

        </ul>
    </li>
@endif
