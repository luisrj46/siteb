<x-default-layout>
    @php
        $title = 'Listado de equipos biomedicos';
    @endphp

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3>{{ $title }}</h3>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-BiomedicalEquipment-table-toolbar="base">
                    <button data-action="create" onclick="BiomedicalEquipment.openForm(this)" data-route="{{ route('biomedicalEquipments.create') }}"
                        type="button" class="btn btn-primary data-modal-app" id="btn-form-BiomedicalEquipment">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Registrar
                    </button>

                </div>
            </div>
        </div>

        <div class="card-body py-4">
            @include('admin.biomedical_equipment.partials.table._table', ['model' => $model])
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script>
            let BiomedicalEquipmentDataTable = App.dataTable.init('table_biomedical_equipments');

            const BiomedicalEquipment = {
                titleModel: 'Equipo biomédico',
                openForm: function(btn) {
                    App.modal.openForm(btn, this.titleModel);
                    return;
                },
                sendForm: function(btn) {
                    App.modal.sendForm(btn, BiomedicalEquipmentDataTable);
                    return;
                },
            }
        </script>
    @endpush

</x-default-layout>
