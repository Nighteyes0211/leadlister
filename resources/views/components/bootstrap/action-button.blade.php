<div class="dropdown">
    <x-bootstrap.button class="btn-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fas fa-ellipsis-v"></i>
        <x-bootstrap.dropdown>
            {{ $slot }}
        </x-bootstrap.dropdown>
    </x-bootstrap.button>
</div>
