@props(['header', 'title' => "We couldn't find any data", 'description' => "Sorry we can't find any data."])

<x-bootstrap.card>
    @if (isset($header))
        <x-slot name="header">
            <h4>{{ $header }}</h4>
        </x-slot>
    @endif

    <div class="empty-state" data-height="400" style="height: 400px;">
        <div class="empty-state-icon d-flex justify-content-center align-items-center">
            <i class="fas fa-question"></i>
        </div>
        <h2>{{ $title }}</h2>
        <p class="lead">
            {{ $description }}
        </p>
        {{-- <a href="#" class="btn btn-primary mt-4">Create new One</a>
        <a href="#" class="mt-4 bb">Need Help?</a> --}}
    </div>
</x-bootstrap.card>
