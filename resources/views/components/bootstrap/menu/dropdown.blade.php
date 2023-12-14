@props(['item' => '', 'route', 'actions' => null])

@if ($slot->isNotEmpty())
    <li class="dropdown {{ request()->routeIs($route) ? 'active' : '' }}">
        <a href="javascript:void(0);" class="nav-link has-dropdown ">
            @if (isset($icon))
                {{ $icon }}
            @endif
            <span data-i18n="Layouts">{{ $item }}</span>
        </a>

        <ul class="dropdown-menu">
            {{ $slot }}
        </ul>
    </li>
@endif
