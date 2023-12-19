<x-layouts.dashboard.app title="Branch">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Niederlassung</x-dayone.page.title>
        </x-slot>
        <x-slot name="right">

            <x-dayone.action.list>
                @if (PageModeEnum::INDEX == $mode)
                    <x-dayone.action.btn action="branch:create" title="Add new Branch" iconClass="feather-plus"
                        href="{{ route('organization.branch.create') }}"></x-dayone.action.btn>
                @endif
            </x-dayone.action.list>

        </x-slot>
    </x-dayone.page.header>

    @if ($mode == PageModeEnum::INDEX)
        @livewire('users.org.modal.delete.confirm')
        <x-bootstrap.card class="min-vh-100">
            @livewire('users.org.index.branch')
        </x-bootstrap.card>
    @else
        @livewire('users.org.branch', ['mode' => $mode, 'branch' => isset($branch) ? $branch : null])
    @endif

</x-layouts.dashboard.app>
