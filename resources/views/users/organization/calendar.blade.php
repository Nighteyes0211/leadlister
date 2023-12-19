<x-layouts.dashboard.app title="Calendar">

    <x-dayone.page.header>
        <x-slot name="left">
            <x-dayone.page.title>Kalender</x-dayone.page.title>
        </x-slot>
    </x-dayone.page.header>

    <!-- Button trigger modal -->
    <button
        type="button"
        class="btn btn-primary btn-lg d-none"
        id="open-appointment-detail"
        data-bs-toggle="modal"
        data-bs-target="#appointment-detail"
    >
        Open appointment
    </button>

    <!-- Modal -->
    <div
        class="modal fade"
        id="appointment-detail"
        tabindex="-1"
        role="dialog"
        aria-labelledby="appointmentTitle"
        aria-hidden="true"
    >
        <div
            class="modal-dialog modal-lg "
            role="document"
        >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="appointmentTitle">
                        Telefontermin Details
                    </h5>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">

                    {{-- $table->string('name');
            $table->string('contact'); --}}

                    <p>Benutzer: <span id="user"></span></p>
                    <p>Name: <span id="name"></span></p>
                    <p>Kontakt: <span id="contact"></span></p>
                    <p>Start: <span id="start"></span></p>
                    <p>Ende: <span id="end"></span></p>

                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal"
                    >
                        Schließen
                    </button>
                </div>
            </div>
        </div>
    </div>


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
            let modalOpener = $("#open-appointment-detail");
            let modal = $("#appointment-detail")

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

                    modal.find("#user").text(arg.event._def.extendedProps.user);
                    modal.find("#name").text(arg.event._def.title);
                    modal.find("#contact").text(arg.event._def.extendedProps.contact);
                    modal.find("#start").text(arg.event._def.extendedProps.appointment_start_time);
                    modal.find("#end").text(arg.event._def.extendedProps.appointment_end_time);

                    modalOpener.click();

                    console.log(arg.event);
                    // if (confirm('Are you sure you want to delete this event?')) {
                    // arg.event.remove()
                    // }
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
