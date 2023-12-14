<x-layouts.dashboard.app title="User">

    @if ($mode != PageModeEnum::EDIT)
        @livewire('users.org.user', compact('mode'))
    @else
        @livewire('users.org.user', ['mode' => $mode, 'user_record' => $user])
    @endif

</x-layouts.dashboard.app>
