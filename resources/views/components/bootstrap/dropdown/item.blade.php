@props(['route', 'action' => null, 'icon' => ''])
@if ($action)
    @permission($action)
        <a class="dropdown-item" href="{{ $route }}">
            @if ($icon)
                <i class="fas fa-{{ $icon }}"></i>
            @endif
            {{ $slot }}
        </a>
    @endpermission
@else
    <a class="dropdown-item" href="{{ $route }}">
        @if ($icon)
            <i class="fas fa-{{ $icon }}"></i>
        @endif
        {{ $slot }}
    </a>
@endif
