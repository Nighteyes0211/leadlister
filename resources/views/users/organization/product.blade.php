<x-layouts.dashboard.app title="Produkte">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Produkte</x-dayone.page.title>
        </x-slot>
        <x-slot name="right">

            <x-dayone.action.list>
                @if (PageModeEnum::INDEX == $mode)
                    <x-dayone.action.btn action="product:create" title="Neues Produkt hinzufügen" iconClass="feather-plus"
                        href="{{ route('organization.product.create') }}"></x-dayone.action.btn>
                @endif
            </x-dayone.action.list>

        </x-slot>
    </x-dayone.page.header>

    @if ($mode == PageModeEnum::INDEX)
        @livewire('users.org.modal.delete.confirm')
        <x-bootstrap.card class="min-vh-100">

            @livewire('users.org.index.product')

        </x-bootstrap.card>
    @else
        @livewire('users.org.product', ['mode' => $mode, 'product' => isset($product) ? $product : null])
    @endif

</x-layouts.dashboard.app>
