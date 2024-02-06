<x-layouts.dashboard.app title="Contact">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Kontakte</x-dayone.page.title>
        </x-slot>
        <x-slot name="right">

            <x-dayone.action.list>
                @if (PageModeEnum::INDEX == $mode)
                    <x-dayone.action.btn action="contact:create" title="Add new Contact" iconClass="feather-plus"
                        href="{{ route('organization.contact.create') }}"></x-dayone.action.btn>
                @else
                    <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                        data-bs-target="#product_modal">Add Product</button>
                @endif
            </x-dayone.action.list>

        </x-slot>
    </x-dayone.page.header>

    @if ($mode == PageModeEnum::INDEX)
        @livewire('users.org.modal.delete.confirm')
        <x-bootstrap.card class="min-vh-100">
            @livewire('users.org.index.contact')
        </x-bootstrap.card>
    @else
        @livewire('users.org.contact', ['mode' => $mode, 'contact' => isset($contact) ? $contact : null])
    @endif

</x-layouts.dashboard.app>
