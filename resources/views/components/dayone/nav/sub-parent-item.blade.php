@props(['hrefs' => [], 'iconClass' => '', 'label'])


@php

    $expandClass = '';

    foreach ($hrefs as $href) {

        if ( request()->routeIs($href) )
        {
            $expandClass = 'is-expanded';
            break;
        }
    }

@endphp

@if ($slot->isNotEmpty())
    <li class="sub-slide {{ $expandClass }} ">
        <a href="#" data-bs-toggle="sub-slide" class="sub-side-menu__item">
            <i class="sidemenu_icon {{ $iconClass ?: 'd-none' }}"></i>
            <span class="sub-side-menu__label">{{ $label }}</span>
            <i class="sub-angle fa fa-angle-right"></i>
        </a>
        <ul class="sub-slide-menu">
            {{ $slot }}
        </ul>
    </li>
@endif
