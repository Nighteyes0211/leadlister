<x-layouts.dashboard.app title="State">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>State</x-dayone.page.title>
        </x-slot>
        <x-slot name="right">

            <x-dayone.action.list>
                @if (PageModeEnum::INDEX == $mode)
                    <x-dayone.action.btn action="state:create" title="Add new State" iconClass="feather-plus"
                        href="{{ route('organization.state.create') }}"></x-dayone.action.btn>
                @endif
            </x-dayone.action.list>

        </x-slot>
    </x-dayone.page.header>

    @if ($mode == PageModeEnum::INDEX)
        @livewire('users.org.modal.delete.confirm')
        <x-bootstrap.card class="min-vh-100">
            @livewire('users.org.index.state')
        </x-bootstrap.card>
    @else
        @livewire('users.org.state', ['mode' => $mode, 'state' => isset($state) ? $state : null])
    @endif

</x-layouts.dashboard.app>
