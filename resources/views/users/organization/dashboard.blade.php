<x-layouts.dashboard.app title="Dashboard">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Dashboard</x-dayone.page.title>
        </x-slot>

    </x-dayone.page.header>


    <div class="row">
        <div class="col-lg-3">
            <x-dayone.stats.stats1 label="Telefontermine heute" value="{{ $currentAppointment }}" iconBg="primary" icon="fa fa-calendar"></x-dayone.stats.stats1>
        </div>
        <div class="col-lg-3">
            <x-dayone.stats.stats1 label="Telefontermine morgen" value="{{ $tomorrowAppointment }}" iconBg="secondary" icon="fa fa-calendar"></x-dayone.stats.stats1>
        </div>
    </div>

</x-layouts.dashboard.app>
