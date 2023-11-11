@php
    $disabled = $request->action == 'view' ? '1' : '';
    $labelFooterEmail = $request->action == 'create' ? 'Se enviaran los datos de acceso a este email' : null;
@endphp
<form id="kt_modal_user_form" method="POST" class="form"
    action="{{ $record->id > 0 ? route('users.update', [$record->id, 'action' => 'profile']) : route('users.update') }}"
    enctype="multipart/form-data">
    <!--begin::Scroll-->
    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
        data-kt-scroll-offset="300px">

        <!--begin::Input group-->
        <x-forms.input-group.index label="Nombre" value="{{ $record->name }}" required="1" name="name"
            :disabled="$disabled" />

        <x-forms.input-group.index type="number" label="Documento" value="{{ $record->document }}" required="1"
            name="document" :disabled="$disabled" />

        <x-forms.input-group.index type="email" label="Email" value="{{ $record->email }}" required="1"
            :labelFooter="$labelFooterEmail" name="email" :disabled="$disabled" />

        <x-forms.input-group.index type="number" label="Teléfono" value="{{ $record->phone }}" required="1"
            name="phone" :disabled="$disabled" />


        <x-forms.input-group.index label="Dirección" value="{{ $record->address }}" name="address" :disabled="$disabled" />

        @if ($request->action != 'view')
            <x-forms.input-group.index type="password" offcomplete="1" label="Contraseña" value="{{ old('password') }}"
                name="password" :disabled="$disabled" />
            <x-forms.input-group.index type="password" offcomplete="1" label="Confirmar contraseña"
                value="{{ old('password_confirmed') }}" name="password_confirmed" :disabled="$disabled" />
        @endif
        @if ($request->action == 'create')
            <x-forms.input-group.index variant="checkbox" label="Generar contraseña automaticamente"
                value="{{ $record->generate_automatically }}" name="generate_automatically" :disabled="$disabled" />
        @endif
        
        <x-forms.input-group.index variant="checkbox" label="Habilitado"
        value="{{ $record->is_enabled }}" name="is_enabled" :disabled="1" />

        <div class="row">
            <div class="col-6">
                <x-forms.input-group.index variant="image" label="Foto" :value="$record->photo_access" name="photo"
                    :disabled="$disabled" />
            </div>
            <div class="col-6">
                <x-forms.input-group.index variant="image" label="Firma" :value="$record->signature_access" name="signature"
                    :disabled="$disabled" />
            </div>
        </div>
    </div>
    <!--end::Scroll-->

</form>
