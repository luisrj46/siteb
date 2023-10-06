@php
    $disabled = '';
@endphp
<form id="kt_modal_user_form" method="POST" class="form" action="{{ route('profile.update') }}"
    enctype="multipart/form-data">
    <!--begin::Scroll-->
    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
        data-kt-scroll-offset="300px">

        <!--begin::Input group-->
        <x-forms.input-group.index label="Nombre" value="{{ $record->name }}" required="1" name="name"
            :disabled="$disabled" />

        <x-forms.input-group.index searchable="0" url="{{ route('get.typeDocument') }}" label="Tipo de documento"
            :value="$record->typeDocument" required="1" name="type_document_id" variant="select2" :disabled="$disabled" />

        <x-forms.input-group.index type="number" label="Documento" value="{{ $record->document }}" required="1"
            name="document" :disabled="$disabled" />

        <x-forms.input-group.index type="email" label="Email" value="{{ $record->email }}" required="1"
            name="email" :disabled="$disabled" />

        <x-forms.input-group.index label="Dirección" value="{{ $record->address }}" name="address" :disabled="$disabled" />

        <x-forms.input-group.index :value="$record->phones" name="phones" id="phones"
            body='admin.user.partials.modal.sub._phones' variant="repeater" label="Teléfonos" labelDelete=""
            required="1" :disabled="$disabled" />

        <x-forms.input-group.index type="password" offcomplete="1" label="Contraseña" value="{{ old('password') }}"
            name="password" :disabled="$disabled" />
        <x-forms.input-group.index type="password" offcomplete="1" label="Confirmar contraseña"
            value="{{ old('password_confirmed') }}" name="password_confirmed" :disabled="$disabled" />
        <x-forms.input-group.index variant="image" label="Foto" :value="$record->photo_access" name="photo"
            :disabled="$disabled" />

        <x-forms.input-group.index variant="textarea" label="Presentación" value="{{ $record->presentation }}"
            name="presentation" :disabled="$disabled" />
    </div>
    <!--end::Scroll-->

</form>
