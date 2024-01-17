<x-layouts.dashboard.app title="Appointment">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Appointment</x-dayone.page.title>
        </x-slot>

    </x-dayone.page.header>

    @livewire('users.org.appointment', compact('appointment'))

</x-layouts.dashboard.app>
