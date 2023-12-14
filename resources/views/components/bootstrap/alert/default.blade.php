@props(['message', 'icon' => '', 'color' => 'success'])
<div class="alert alert-{{ $color }} d-flex align-items-center" role="alert">

    @if ($icon)
        <i class="mdi mdi-{{ $icon }}"></i>
    @endif

    <div>
        {{ $message }}
    </div>
</div>
