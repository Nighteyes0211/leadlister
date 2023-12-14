@props(['route', 'action' => null])

@if ($action)
    @can($action)
        <li class="{{ request()->routeIs($route) ? 'active' : '' }}">
            <a href="{{ route($route) }}" class="nav-link">
                @if (isset($icon))
                    {{ $icon }}
                @endif
                <span>{{ $slot }}</span>
            </a>
        </li>
    @endcan
@else
    <li class="{{ request()->routeIs($route) ? 'active' : '' }}">
        <a href="{{ route($route) }}" class="nav-link">
            @if (isset($icon))
                {{ $icon }}
            @endif
            <span>{{ $slot }}</span>
        </a>
    </li>
@endif
