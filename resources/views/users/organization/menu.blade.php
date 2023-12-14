
<x-dayone.nav.item href="{{ route('organization.dashboard') }}" iconClass="fa fa-home">Dashboard</x-dayone.nav.item>
<x-dayone.nav.item href="{{ route('organization.calendar') }}" iconClass="fa fa-calendar">Calendar</x-dayone.nav.item>


<x-dayone.nav.parent-item iconClass="fa fa-user" :hrefs="['organization.user.*', 'organization.role.*']" label="User management">

    <x-dayone.nav.sub-item action="user:index" href="{{ route('organization.user.index') }}">Users</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="role:index" href="{{ route('organization.role.index') }}">Role</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>

<x-dayone.nav.parent-item iconClass="fa fa-phone" :hrefs="['organization.contact.*']" label="Contact">

    <x-dayone.nav.sub-item action="contact:index" href="{{ route('organization.contact.index') }}">Show all</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="contact:create" href="{{ route('organization.contact.create') }}">Create</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>

<x-dayone.nav.parent-item iconClass="fa fa-users" :hrefs="['organization.facility.*']" label="Facility">

    <x-dayone.nav.sub-item action="facility:index" href="{{ route('organization.facility.index') }}">Show all</x-dayone.nav.sub-item>
    <x-dayone.nav.sub-item action="facility:create" href="{{ route('organization.facility.create') }}">Create</x-dayone.nav.sub-item>

</x-dayone.nav.parent-item>