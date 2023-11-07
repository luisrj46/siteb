<x-default-layout>
    @php
        $title = 'Agenda';
    @endphp

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3>{{ $title }}</h3>
            </div>
        </div>

        <div class="card-body py-4">
            <div id="kt_docs_fullcalendar_selectable"></div>
        </div>
    </div>
    @push('scripts')
        <script>
            var calendarEl = document.getElementById("kt_docs_fullcalendar_selectable");

            var calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                headerToolbar: {
                    left: "prev,next today",
                    center: "title",
                    right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
                },
                initialDate: Date.now(),
                navLinks: true, // can click day/week names to navigate views
                selectable: true,
                selectMirror: true,

                // Delete event
                eventChange: function(event) {
                    console.log(event);
                },
                eventClick: function(arg) {
                    let maintenanceId = arg.event._def.publicId;
                    let url = @json(route('maintenances.execution.form', [-1]));
                    let newUrl = url.replace('-1', maintenanceId)

                    let new_element = $(
                        '<i title="Ejecutar" onclick="Maintenance.openForm(this)" data-action="execution" data-route="' +
                        newUrl +
                        '" class="bi cursor-pointer fs-2 btn-sm text-info bi-journal-check me-1 data-modal-app"></i>'
                    );

                    Swal.fire({
                        text: "Desea ejecutar el mantenimiento al equipo " + arg.event._def.title + "?",
                        icon: "warning",
                        showCancelButton: true,
                        buttonsStyling: false,
                        confirmButtonText: "Si, Ejecutar!",
                        cancelButtonText: "No, cerrar",
                        customClass: {
                            confirmButton: "btn btn-primary",
                            cancelButton: "btn btn-active-light"
                        }
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            new_element.trigger('click');
                        }
                    });
                },
                editable: false,
                dayMaxEvents: true,
                events: function(info, successCallback, failureCallback) {
                    KTApp.showPageLoading();
                    axios.get(@json(route('maintenances.events')), {
                        params: {
                            start: info.startStr,
                            end: info.endStr
                        }
                    }).then(function(result) {
                        let success = successCallback(
                            result?.data?.data?.map(function(eventEl) {
                                return eventEl
                            })
                        )
                    }).finally(function() {
                        setTimeout(() => {
                            KTApp.hidePageLoading();
                        }, 1000);
                    });
                }

            });

            calendar.render();

            const Maintenance = {
                titleModel: 'mantenimiento',
                openForm: function(btn) {
                    App.modal.openForm(btn, this.titleModel);
                    return;
                },
                sendForm: function(btn) {
                    App.modal.sendForm(btn);
                    return;
                },
            }
        </script>
    @endpush

</x-default-layout>
