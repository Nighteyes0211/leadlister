<x-layouts.dashboard.app title="Facility-type">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Facility Type</x-dayone.page.title>
        </x-slot>
        <x-slot name="right">

            <x-dayone.action.list>
                @if (PageModeEnum::INDEX == $mode)
                    <x-dayone.action.btn action="facility-type:create" title="Add new Facility Type" iconClass="feather-plus"
                        href="{{ route('organization.facility-type.create') }}"></x-dayone.action.btn>
                @endif
            </x-dayone.action.list>

        </x-slot>
    </x-dayone.page.header>

    @if ($mode == PageModeEnum::INDEX)
        @livewire('users.org.modal.delete.confirm')
        <x-bootstrap.card class="min-vh-100">
            @livewire('users.org.index.facility-type')
        </x-bootstrap.card>
    @else
        @livewire('users.org.facility-type', ['mode' => $mode, 'facilityType' => isset($facilityType) ? $facilityType : null])
    @endif

</x-layouts.dashboard.app>
