@props(['title' => '', 'date' => '', 'content' => '', 'footer' => ''])
<div {!! $attributes->merge(['class' => 'list-group-item list-group-item-action flex-column align-items-start border-0']) !!}>
    <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{ $title }}</h5>
        <small class="text-muted">{{ $date }}</small>
    </div>
    <p class="mb-1">{{ $content }}</p>
    <small class="text-muted">{{ $footer }}</small>
</div>
