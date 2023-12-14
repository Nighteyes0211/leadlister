@props(['avatar' => 'assets/img/avatar/avatar-1.png', 'datetime' => null, 'title' => null, 'text' => null, 'titleclass' => null, 'route' => null])
<li {!! $attributes->merge(['class' => 'media']) !!}>
    <img class="mr-3 rounded-circle" width="50" src="{{ asset($avatar) }}" alt="avatar">
    <div class="media-body">
        <div class="float-right text-seconadry">{{ $datetime }}</div>
        <div class="media-title">
            @if ($route)
                <a href="{{ $route }}">
                    <span class="{{ $titleclass }}">{{ $title }}</span>
                </a>
            @else
                <span class="{{ $titleclass }}"> {{ $title }} </span>
            @endif
        </div>
        @if ($text)
            <span class="text-small text-muted">{{ $text }}</span>
        @endif
    </div>
</li>
