@php
    $disabled = $request->action == 'view' ? '1' : '';
@endphp
<form id="kt_modal_user_form" method="POST" class="form"
    action="{{ $record->id > 0 ? route('biomedicalEquipments.update', $record->id) : route('biomedicalEquipments.store') }}"
    enctype="multipart/form-data">
    <!--begin::Scroll-->
    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
        data-kt-scroll-offset="300px">

        <!--begin::Input group-->
        <x-forms.input-group.index label="Nombre" value="{{ $record->name }}" required="1" name="name" :disabled="$disabled" />
        
        <x-forms.input-group.index label="Marca" value="{{ $record->brand }}" required="1" name="brand" :disabled="$disabled" />
        
        <x-forms.input-group.index label="Modelo" value="{{ $record->model }}" required="1" name="model" :disabled="$disabled" />

        <x-forms.input-group.index label="Serie" value="{{ $record->series }}" required="1" name="series" :disabled="$disabled" />
        
        <x-forms.input-group.index label="Codigo activo" value="{{ $record->active_code }}" required="1" name="active_code" :disabled="$disabled" />
        
        <x-forms.input-group.index label="Servicio" required="1" :value="$record->service" url="{{ route('get.services') }}" variant="select2" name="service_id" :disabled="$disabled" />
        
        <x-forms.input-group.index label="Ambiente" value="{{ $record->ambient }}" name="ambient" :disabled="$disabled" />

        <x-forms.input-group.index label="Registro invima" value="{{ $record->invima_register }}" name="invima_register" :disabled="$disabled" />

        <x-forms.input-group.index label="Costo" type="number" value="{{ $record->cost }}" name="cost" :disabled="$disabled" />

        <x-forms.input-group.index searchable="false" variant="select2" url="{{ route('get.form.acquisition') }}" label="Forma de adquisición" :value="$record->formAcquisition" name="form_acquisition_id" :disabled="$disabled" />

        <x-forms.input-group.index url="{{ route('get.property') }}" label="Propiedad" :value="$record->property" name="property_id" searchable="false" variant="select2" :disabled="$disabled" />

        <x-forms.input-group.index label="Fecha de compra" variant="date-range" single="1" startDateValue="{{ $record->date_purchase }}" name="date_purchase" :disabled="$disabled" />

        <x-forms.input-group.index label="Condición de recepción" value="{{ $record->reception_condition }}" name="reception_condition" :disabled="$disabled" />

        <x-forms.input-group.index label="Año de producción" value="{{ $record->year_production }}" name="year_production" :disabled="$disabled" />

        <x-forms.input-group.index label="Fabricante" value="{{ $record->maker }}"  name="maker" :disabled="$disabled" />
            
        <x-forms.input-group.index label="Teléfono del fabricante" value="{{ $record->manufacturer_phone }}" name="manufacturer_phone" :disabled="$disabled" />

        <x-forms.input-group.index label="Representante" value="{{ $record->representative }}" name="representative" :disabled="$disabled" />

        <x-forms.input-group.index label="Teléfono representante" value="{{ $record->representative_phone }}" name="representative_phone" :disabled="$disabled" />

        <x-forms.input-group.index label="Periodicidad del mantenimiento preventivo" :value="$record->periodicityPreventive" searchable="false" variant="select2" url="{{ route('get.period') }}"  name="periodicity_preventive" :disabled="$disabled" />
            
        <x-forms.input-group.index label="Requiere calibración" required="1" :value="$record->requiresCalibration" url="{{ route('get.yes.not') }}" searchable="false" variant="select2" name="requires_calibration" :disabled="$disabled" />
            
        <x-forms.input-group.index label="Periodo de calibración" :value="$record->calibrationPeriodicity" searchable="false" variant="select2" url="{{ route('get.period') }}"  name="calibration_periodicity" :disabled="$disabled" />

        <x-forms.input-group.index label="Manual de operación" required="1" :value="$record->operationManual" url="{{ route('get.yes.not') }}" searchable="false" variant="select2" name="operation_manual" :disabled="$disabled" />

        <x-forms.input-group.index label="Manual de mantenimiento" required="1" :value="$record->maintenanceManual"  url="{{ route('get.yes.not') }}" searchable="false" variant="select2" name="maintenance_manual" :disabled="$disabled" />

        <x-forms.input-group.index label="Planos" required="1" :value="$record->plan"  url="{{ route('get.plan') }}" searchable="false" variant="select2" name="plan_id" :disabled="$disabled" />

        <x-forms.input-group.index label="Usos" :value="$record->useBiomedical"  url="{{ route('get.use.biomedical') }}" searchable="false" variant="select2" name="use_biomedical_id" :disabled="$disabled" />

        <x-forms.input-group.index label="Clasificación biomédica" :value="$record->biomedicalClassification" searchable="false" variant="select2" url="{{ route('get.biomedical.classification') }}"  name="biomedical_classification_id" :disabled="$disabled" />

        <x-forms.input-group.index label="Clase de riesgo" :value="$record->riskClass" url="{{ route('get.risk.class') }}" searchable="false" variant="select2" name="risk_class_id" :disabled="$disabled" />

        <x-forms.input-group.index label="Frecuencia" value="{{ $record->frequency }}" name="frequency" :disabled="$disabled" />

        <x-forms.input-group.index label="Peso" value="{{ $record->weight }}" name="weight" :disabled="$disabled" />

        <x-forms.input-group.index label="Temperature" value="{{ $record->temperature }}" name="temperature" :disabled="$disabled" />

        <x-forms.input-group.index label="Fuente de alimentación" value="{{ $record->power_supply }}" name="power_supply" :disabled="$disabled" />

        <x-forms.input-group.index label="Voltaje" :value="$record->voltage" name="voltage" :disabled="$disabled" />
        
        @can('biomedical.equipment.disable', $record)
            <x-forms.input-group.index variant="checkbox" label="Habilitado" value="{{ $record->is_enabled }}" checked="{{ $request->action == 'create' ? 1 : 0 }}" name="is_enabled" :disabled="$disabled" />
        @endcan
        
        <x-forms.input-group.index :value="$record->maintenanceItems" name="items" id="items"  body='admin.biomedical_equipment.partials.modal.sub._items' variant="repeater" label="Items de mantenimiento preventivo" :disabled="$disabled" />

        <x-forms.input-group.index :value="$record->components" name="components" id="components"  body='admin.biomedical_equipment.partials.modal.sub._components' variant="repeater" label="Componentes" :disabled="$disabled" />

        <x-forms.input-group.index variant="textarea" label="Descripción" value="{{ $record->description }}"
                name="description" :disabled="$disabled" />

        <x-forms.input-group.index variant="image" label="Foto" :value="$record->photo_access" name="photo"
                    :disabled="$disabled" />
    </div>
    <!--end::Scroll-->

</form>
