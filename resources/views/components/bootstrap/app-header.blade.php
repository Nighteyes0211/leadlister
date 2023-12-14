@props(['title' => '', 'desc' => ''])
<div>
    <div>
        <h1>{{ $title }}</h1>
        @if ($desc)<p class="mt-2">{{ $desc }}</p> @endif
    </div>
</div>
<div>
    {{ $slot }}
</div>

