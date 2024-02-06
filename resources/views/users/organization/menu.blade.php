
<x-dayone.nav.item href="{{ route('organization.dashboard') }}" iconClass="fa fa-home">Dashboard</x-dayone.nav.item>


<x-dayone.nav.parent-item iconClass="fa fa-users" :hrefs="['organization.state.*']" label="Bundesland">

    <x-dayone.nav.sub-item action="state:index" href="{{ route('organization.state.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="state:create" href="{{ route('organization.state.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>

<x-dayone.nav.parent-item iconClass="fa-solid fa-cart-shopping" :hrefs="['organization.product.*']" label="Produkte">

    <x-dayone.nav.sub-item action="product:index" href="{{ route('organization.product.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="product:create" href="{{ route('organization.product.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>


<x-dayone.nav.parent-item iconClass="fa-regular fa-building" :hrefs="['organization.facility.*']" label="Einrichtungen">

    <x-dayone.nav.sub-item action="facility:index" href="{{ route('organization.facility.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="facility:create" href="{{ route('organization.facility.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>


<x-dayone.nav.parent-item iconClass="fa-regular fa-building" :hrefs="['organization.facility-status.*']" label="Einrichtungsstatus">

    <x-dayone.nav.sub-item action="status:index" href="{{ route('organization.facility-status.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="status:create" href="{{ route('organization.facility-status.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>


<x-dayone.nav.parent-item iconClass="fa-regular fa-building" :hrefs="['organization.facility-type.*']" label="Einrichtungenstyp">

    <x-dayone.nav.sub-item action="facility-type:index" href="{{ route('organization.facility-type.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="facility-type:create" href="{{ route('organization.facility-type.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>



<x-dayone.nav.parent-item iconClass="fa fa-phone" :hrefs="['organization.contact.*']" label="Kontakte">

    <x-dayone.nav.sub-item action="contact:index" href="{{ route('organization.contact.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="contact:create" href="{{ route('organization.contact.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>


<x-dayone.nav.item href="{{ route('organization.calendar') }}" iconClass="fa fa-calendar">Kalender</x-dayone.nav.item>

<x-dayone.nav.item href="{{ route('organization.appointment.index') }}" iconClass="fa fa-circle-o">Termine</x-dayone.nav.item>




<x-dayone.nav.parent-item iconClass="fa fa-user" :hrefs="['organization.user.*', 'organization.role.*']" label="Benutzerverwaltung">

    <x-dayone.nav.sub-item action="user:index" href="{{ route('organization.user.index') }}">Benutzer</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="role:index" href="{{ route('organization.role.index') }}">Rollen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>





{{-- <x-dayone.nav.parent-item iconClass="fa fa-location-arrow" :hrefs="['organization.branch.*']" label="Niederlassung">

    <x-dayone.nav.sub-item action="branch:index" href="{{ route('organization.branch.index') }}">Übersicht</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="branch:create" href="{{ route('organization.branch.create') }}">Erstellen</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item> --}}
