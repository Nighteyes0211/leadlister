<x-layouts.dashboard.app title="Calendar">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Calendar</x-dayone.page.title>
        </x-slot>
    </x-dayone.page.header>

    <div class="card">
        <div class="card-body">
            <div id="calendar" class="position-sticky"></div>
        </div>
    </div>

    <x-slot name="foot">
        <script src='{{ asset('backend/plugins/fullcalendar/fullcalendar.min.js') }}'></script>
		{{-- <script src="{{ asset('backend/js/app-calendar-events.js') }}"></script> --}}


        <script>
            // sample calendar events data
            'use strict'
            var curYear = moment().format('YYYY');
            var curMonth = moment().format('MM');
            // Calendar Event Source
            var appointments = {
                id: 1,
                events: @json($appointments)
            };


            //________ FullCalendar
            document.addEventListener('DOMContentLoaded', function() {

                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                navLinks: true, // can click day/week names to navigate views
                businessHours: true, // display business hours
                editable: true,
                selectable: true,
                selectMirror: true,
                droppable: true, // this allows things to be dropped onto the calendar
                drop: function(arg) {
                    // is the "remove after drop" checkbox checked?
                    if (document.getElementById('drop-remove').checked) {
                    // if so, remove the element from the "Draggable Events" list
                    arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                    }
                },
                select: function(arg) {
                    var title = prompt('Event Title:');
                    if (title) {
                    calendar.addEvent({
                        title: title,
                        start: arg.start,
                        end: arg.end,
                        allDay: arg.allDay
                    })
                    }
                    calendar.unselect()
                },
                eventClick: function(arg) {
                    if (confirm('Are you sure you want to delete this event?')) {
                    arg.event.remove()
                    }
                },
                editable: true,
                    eventSources: [appointments],

                });
                calendar.render();
            });

        </script>



		{{-- <script src="{{ asset('backend/js/app-calendar.js') }}"></script> --}}
    </x-slot>
</x-layouts.dashboard.app>
