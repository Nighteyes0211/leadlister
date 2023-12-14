@props(['title' => 'title', 'message' => '', 'color' => 'green', 'event', 'livewire' => true])
@php
    $hasEvent = Session::has($event) ?: 0;
    $livewire = $livewire ?: 0;
@endphp


@if ($livewire)

    <script>
        window.addEventListener('livewire:load', function() {
            Livewire.on("{{ $event }}", function(data) {

                message = "{{ $message }}" != '' ? "{{ $message }}" : data.message

                iziToast.show({
                    title: "{{ $title }}",
                    message: message,
                    color: "{{ $color }}"
                });
            })
        })
    </script>
@else
    @if (session()->has($event))
        <script>
            document.addEventListener("DOMContentLoaded", () => {
                message = "{{ $message }}" != '' ? "{{ $message }}" : '{{ session()->get("$event") }}'

                iziToast.show({
                    title: "{{ $title }}",
                    message: message,
                    color: "{{ $color }}"
                });
            });
        </script>
    @endif


@endif
