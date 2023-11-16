<x-default-layout>
    @php
        $title = 'Listado de mantenimientos';
    @endphp

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3>{{ $title }}</h3>
            </div>
            @can('store', $model)
                <div class="card-toolbar">
                    <div class="d-flex justify-content-end" data-kt-Maintenance-table-toolbar="base">
                        <button data-action="create" onclick="Maintenance.openForm(this)"
                            data-route="{{ route('maintenances.create') }}" type="button"
                            class="btn btn-primary data-modal-app" id="btn-form-Maintenance">
                            {!! getIcon('plus', 'fs-2', '', 'i') !!}
                            Registrar
                        </button>

                    </div>
                </div>
            @endcan
        </div>

        <div class="card-body py-4">
            @include('admin.maintenance.partials.table._table', ['model' => $model])
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script>
            let MaintenanceDataTable = App.dataTable.init('table_maintenances', idd);

            const Maintenance = {
                titleModel: 'mantenimiento',
                openForm: function(btn) {
                    App.modal.openForm(btn, this.titleModel);
                    return;
                },
                sendForm: function(btn) {
                    App.modal.sendForm(btn, MaintenanceDataTable);
                    return;
                },
            }
        </script>
    @endpush

</x-default-layout>
