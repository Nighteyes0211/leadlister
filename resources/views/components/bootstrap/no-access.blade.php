@props([
    'icon' => 'lock',
    'title' => 'No access',
    'message' => "Sorry! You don't have access to this resource.",
    'actionbtnname' => 'Go back',
    'type' => 'danger',
    'actionbtnhref' => redirect()
        ->back()
        ->getTargetUrl(),
])


<div class="empty-state">
    <div class="empty-state-icon bg-{{ $type }}">
        <i class="fas fa-{{ $icon }}"></i>
    </div>
    <h2>{{ $title }}</h2>
    <p class="lead">
        {{ $message }}
    </p>

    <a href='{{ $actionbtnhref }}' class='btn btn-{{ $type }} mt-4'>
        {{ $actionbtnname }}</a>
</div>
