@props(['title', 'color' => 'secondary'])
<div class="btn-group">
    <button class="btn btn-{{ $color }} btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="false">
        {{ $title }}
    </button>
    <div class="dropdown-menu">
        {{ $slot }}
    </div>
</div>
