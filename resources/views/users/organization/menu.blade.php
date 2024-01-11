
<x-dayone.nav.item href="{{ route('organization.dashboard') }}" iconClass="fa fa-home">Dashboard</x-dayone.nav.item>


<x-dayone.nav.parent-item iconClass="fa fa-users" :hrefs="['organization.facility.*']" label="Einrichtungen">

    <x-dayone.nav.sub-item action="facility:index" href="{{ route('organization.facility.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="facility:create" href="{{ route('organization.facility.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>


<x-dayone.nav.parent-item iconClass="fa fa-users" :hrefs="['organization.facility-type.*']" label="Art der Anlage">

    <x-dayone.nav.sub-item action="facility-type:index" href="{{ route('organization.facility-type.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="facility-type:create" href="{{ route('organization.facility-type.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>



<x-dayone.nav.parent-item iconClass="fa fa-phone" :hrefs="['organization.contact.*']" label="Kontakte">

    <x-dayone.nav.sub-item action="contact:index" href="{{ route('organization.contact.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="contact:create" href="{{ route('organization.contact.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>


<x-dayone.nav.item href="{{ route('organization.calendar') }}" iconClass="fa fa-calendar">Kalender</x-dayone.nav.item>


<x-dayone.nav.parent-item iconClass="fa fa-user" :hrefs="['organization.user.*', 'organization.role.*']" label="User management">

    <x-dayone.nav.sub-item action="user:index" href="{{ route('organization.user.index') }}">Benutzer</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="role:index" href="{{ route('organization.role.index') }}">Rollen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>





{{-- <x-dayone.nav.parent-item iconClass="fa fa-location-arrow" :hrefs="['organization.branch.*']" label="Niederlassung">

    <x-dayone.nav.sub-item action="branch:index" href="{{ route('organization.branch.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="branch:create" href="{{ route('organization.branch.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item> --}}
