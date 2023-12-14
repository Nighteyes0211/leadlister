@props(['action' => '', 'iconClass'])

@if ($action)
    @can($action)
        <a {!! $attributes->merge(['class' => 'btn btn-primary']) !!}>
            <i class="{{ $iconClass }}"></i>
        </a>
    @endcan
@else
    <a {!! $attributes->merge(['class' => 'btn btn-primary']) !!}>
        <i class="{{ $iconClass }}"></i>
    </a>
@endif
