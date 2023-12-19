<x-layouts.dashboard.app title="Role">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Rollen</x-dayone.page.title>
        </x-slot>
        <x-slot name="right">

            <x-dayone.action.list>
                @if (PageModeEnum::INDEX == $mode)
                    <x-dayone.action.btn action="role:create" title="Neue Rolle hinzufügen" iconClass="feather-plus"
                        href="{{ route('organization.role.create') }}"></x-dayone.action.btn>
                @endif
            </x-dayone.action.list>

        </x-slot>
    </x-dayone.page.header>

    @livewire('users.org.role', ['mode' => $mode, 'role' => isset($role) ? $role : null])

</x-layouts.dashboard.app>
