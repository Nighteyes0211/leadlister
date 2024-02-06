<x-layouts.dashboard.app title="Appointment">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Appointment</x-dayone.page.title>
        </x-slot>

    </x-dayone.page.header>

    @if ($mode == PageModeEnum::INDEX)
        <x-bootstrap.card class="min-vh-100">

            @livewire('users.org.index.appointment')

        </x-bootstrap.card>
    @else
        @livewire('users.org.appointment', compact('appointment'))
    @endif

</x-layouts.dashboard.app>
