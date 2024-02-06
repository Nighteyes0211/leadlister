<x-layouts.dashboard.app title="Facility">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Einrichtungen</x-dayone.page.title>
        </x-slot>
        <x-slot name="right">

            <x-dayone.action.list>
                @if (PageModeEnum::INDEX == $mode)
                    <x-dayone.action.btn action="facility:create" title="Add new facility" iconClass="feather-plus"
                        href="{{ route('organization.facility.create') }}"></x-dayone.action.btn>
                @else
                    <div class="d-flex gap-3">
                        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#facility_modal">Add Product</button>
                        @livewire('users.org.modal.create.appointment')
                    </div>
                @endif
            </x-dayone.action.list>

        </x-slot>
    </x-dayone.page.header>

    @if ($mode == PageModeEnum::INDEX)
        @livewire('users.org.modal.delete.confirm')
        <x-bootstrap.card class="min-vh-100">
            @livewire('users.org.index.facility')
        </x-bootstrap.card>
    @else
        @livewire('users.org.facility', ['mode' => $mode, 'facility' => isset($facilty) ? $facilty : null])
    @endif

</x-layouts.dashboard.app>
