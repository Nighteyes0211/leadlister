@props(['action', 'color' => 'primary', 'size' => 'sm', 'href'])

@if (isset($action))

    @can($action)
        @if (isset($href))
            <a href="{{ $href }}" {!! $attributes->merge(['class' => "btn btn-{$color} btn-{$size}"]) !!}>{{ $slot }}</a>
        @else
            <button type="button" {!! $attributes->merge(['class' => "btn btn-{$color} btn-{$size}"]) !!} >
                {{ $slot }}
            </button>
        @endif
    @endcan

@else

    @if (isset($href))
        <a href="{{ $href }}" {!! $attributes->merge(['class' => "btn btn-{$color} btn-{$size}"]) !!}>{{ $slot }}</a>
    @else
        <button type="button" {!! $attributes->merge(['class' => "btn btn-{$color} btn-{$size}"]) !!} >
            {{ $slot }}
        </button>
    @endif

@endif
