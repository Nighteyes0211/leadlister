@props(['title', 'icon'])
<div class="card card-statistic-2 pb-4">
    <div class="card-stats ">
        <div class="card-stats-title">{{ $title }}</div>
        <div class="card-stats-items">
            {{ $items }}
        </div>
    </div>
    @if (isset($icon))
        <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-{{ $icon }}"></i>
        </div>
    @endif
</div>
