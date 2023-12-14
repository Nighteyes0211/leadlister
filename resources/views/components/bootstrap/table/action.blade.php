@props(['route', 'action' => null])
@if ($action)
    @can($action)
        <a href="{{ $route }}">{{ $slot }}</a>
        <div class="bullet"></div>
    @endcan
@else
    <a href="{{ $route }}">{{ $slot }}</a>
    <div class="bullet"></div>
@endif
