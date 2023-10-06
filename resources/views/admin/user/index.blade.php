<x-default-layout>
    @php
        $title = 'Listado de usuarios';
    @endphp

    <div class="card">
        <div class="card-header border-0 pt-6">
            <div class="card-title">
                <h3>{{ $title }}</h3>
            </div>

            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button data-action="create" onclick="User.openForm(this)" data-route="{{ route('users.create') }}"
                        type="button" class="btn btn-primary data-modal-app" id="btn-form-user">
                        {!! getIcon('plus', 'fs-2', '', 'i') !!}
                        Registrar
                    </button>

                </div>
            </div>
        </div>

        <div class="card-body py-4">
            @include('admin.user.partials.table._table', ['model' => $model])
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
        <script>
            let UserDataTable = App.dataTable.init('table_users');

            const User = {
                titleModel: 'usuario',
                openForm: function(btn) {
                    App.modal.openForm(btn, this.titleModel);
                    return;
                },
                sendForm: function(btn) {
                    App.modal.sendForm(btn, UserDataTable);
                    return;
                },
            }
        </script>
    @endpush

</x-default-layout>
