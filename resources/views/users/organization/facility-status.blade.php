<x-layouts.dashboard.app title="Facility-status">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Facility status</x-dayone.page.title>
        </x-slot>
        <x-slot name="right">

            <x-dayone.action.list>
                @if (PageModeEnum::INDEX == $mode)
                    <x-dayone.action.btn action="status:create" title="Add new Facility Status" iconClass="feather-plus"
                        href="{{ route('organization.facility-status.create') }}"></x-dayone.action.btn>
                @endif
            </x-dayone.action.list>

        </x-slot>
    </x-dayone.page.header>

    @if ($mode == PageModeEnum::INDEX)
        @livewire('users.org.modal.delete.confirm')
        <x-bootstrap.card class="min-vh-100">
            @livewire('users.org.index.facility-status')
        </x-bootstrap.card>
    @else
        @livewire('users.org.facility-status', ['mode' => $mode, 'facilityStatus' => isset($facility_status) ? $facility_status : null])
    @endif

</x-layouts.dashboard.app>
