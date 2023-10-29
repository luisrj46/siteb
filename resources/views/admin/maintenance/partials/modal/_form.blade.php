@php
    $disabled_view = $request->action == 'view' || $request->action == 'execution' ? '1' : '';
    $disabled_execution = $request->action == 'view' ? '1' : '';
    $execution = $record->maintenanceExecution;
    $action = $request->action == 'edit' ? 'update' : 'execution';
    $optionsItem = $record->biomedicalEquipment?->getOptionsItem();
@endphp

<form id="kt_modal_user_form" method="POST" class="form"
    action="{{ $record->id > 0 ? route("maintenances.$action", ['maintenance' => $record->id, 'action' => $request->action]) : route('maintenances.store', ['action' => $request->action]) }}"
    enctype="multipart/form-data">
    <!--begin::Scroll-->
    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
        data-kt-scroll-offset="300px">

        <!--begin::Input group-->
        <x-forms.input-group.index searchable="false" variant="select2" url="{{ route('get.type.maintenance') }}"
            label="Tipo" :value="$record->maintenanceType" required="1" name="maintenance_type_id" :disabled="$disabled_view" />

        <x-forms.input-group.index required="1" url="{{ route('get.biomedical.equipment') }}" label="Equipo biomédico"
            :value="$record->biomedicalEquipment" name="biomedical_equipment_id" variant="select2" :disabled="$disabled_view" />

        <x-forms.input-group.index required="1" url="{{ route('get.responsible') }}" label="Responsable"
            keysValues="name|document" :value="$record->user" name="user_id" variant="select2" :disabled="$disabled_view" />

        <x-forms.input-group.index required="1" label="Fecha programada" variant="date-range" single="1"
            startDateValue="{{ $record->scheduled_date }}" name="scheduled_date" :disabled="$disabled_view"
            minDate="{{ now() }}" :timePicker="true" />

        <x-forms.input-group.index variant="textarea" label="Observaciones" value="{{ $record->observation }}"
            name="observation" :disabled="$disabled_view" />
        @if ($record->created_by)
            <x-forms.input-group.index url="{{ route('get.user') }}" label="Registrado por" keysValues="name|document"
                :value="$record->createdBy" name="created_by" variant="select2" :disabled="1" />
        @endif
        @if ($execution || $request->action == 'execution')
            <div class="text-center">
                <hr>
                <h3 class="pt-2">Ejecución</h3>
            </div>
            <input type="hidden" value="{{ $execution?->id }}" name="execution_id"
                :disabled="{{ $disabled_execution }}">
            <x-forms.input-group.index required="1" label="Fecha inicio" variant="date-range" single="1"
                startDateValue="{{ $execution?->start_date }}" name="execution_start_date" :disabled="$disabled_execution"
                :timePicker="true" />

            <x-forms.input-group.index required="1" label="Fecha fin" variant="date-range" single="1"
                startDateValue="{{ $execution?->end_date }}" name="execution_end_date" :disabled="$disabled_execution"
                :timePicker="true" />

            @if (
                $record->biomedicalEquipment->maintenanceItems->count() > 0 &&
                    $record->maintenanceType->slug == $record->maintenanceType::PREVENTIVE)
                <h4 class="mb-2">Items de mantenimiento preventivo</h4>

                @foreach ($record->maintenanceExecution->detailExecutions ?? $record->biomedicalEquipment->maintenanceItems as $key => $item)
                    <div class="mb-4">
                        <x-forms.label.index :required="true" :label="$key + 1 . '. ' . ($item?->maintenanceItem?->description ?? $item->description)" />
                        @php
                            $idd = $item->maintenance_item_id ?? $item->id;
                            $name = "items[$idd]";
                        @endphp
                        @foreach ($optionsItem as $option)
                            <x-forms.radio.index :checked="$item?->yes_or_not_id == $option->id" class="mb-2" :name="$name" :value="$option->id"
                                keyName="items" :label="$option->name" />
                        @endforeach
                        <span id="error_{{ $name }}" class="text-danger d-none"></span>

                    </div>
                @endforeach
            @endif

            <x-forms.input-group.index required="1" variant="textarea" label="Materiales"
                value="{{ $execution?->materials }}" name="execution_materials" :disabled="$disabled_execution" />

            <x-forms.input-group.index required="1" variant="textarea" label="Observaciones"
                value="{{ $execution?->observation }}" name="execution_observation" :disabled="$disabled_execution" />

            <x-forms.input-group.index required="1" variant="image" label="Firma jefe" :value="$execution?->signature_boss_access"
                name="execution_boss_signature" :disabled="$disabled_execution" />

            @if ($execution?->user)
                <x-forms.input-group.index url="{{ route('get.user') }}" label="Ejecutado por"
                    keysValues="name|document" :value="$execution?->user" name="execution_user_id" variant="select2"
                    :disabled="1" />
            @endif
        @endif

    </div>
    <!--end::Scroll-->

</form>
