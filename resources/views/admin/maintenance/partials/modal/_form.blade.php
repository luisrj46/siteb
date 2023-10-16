@php
    $disabled = $request->action == 'view' ? '1' : '';
@endphp
<form id="kt_modal_user_form" method="POST" class="form"
    action="{{ $record->id > 0 ? route('maintenances.update', $record->id) : route('maintenances.store') }}"
    enctype="multipart/form-data">
    <!--begin::Scroll-->
    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
        data-kt-scroll-offset="300px">

        <!--begin::Input group-->
        <x-forms.input-group.index searchable="false" variant="select2" url="{{ route('get.type.maintenance') }}" label="Tipo" :value="$record->maintenanceType" required="1" name="maintenance_type_id" :disabled="$disabled" />

        <x-forms.input-group.index required="1" url="{{ route('get.biomedical.equipment') }}" label="Equipo biomédico" :value="$record->biomedicalEquipment" name="biomedical_equipment_id" variant="select2" :disabled="$disabled" />
        
        <x-forms.input-group.index required="1" url="{{ route('get.responsible') }}" label="Responsable" keysValues="name|document" :value="$record->user" name="user_id" variant="select2" :disabled="$disabled" />

        <x-forms.input-group.index required="1" label="Fecha programada" variant="date-range" single="1" startDateValue="{{ $record->scheduled_date }}" name="scheduled_date" :disabled="$disabled" minDate="{{now()}}" :timePicker="true" />

        <x-forms.input-group.index variant="textarea" label="Observaciones" value="{{ $record->observation }}" name="observation" :disabled="$disabled" />
        
        <x-forms.input-group.index url="{{ route('get.user') }}" label="Registrado por" keysValues="name|document" :value="$record->createdBy" name="created_by" variant="select2" :disabled="1" />
        
    </div>
    <!--end::Scroll-->

</form>
