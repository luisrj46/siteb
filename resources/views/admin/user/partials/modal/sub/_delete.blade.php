<form id="kt_modal_user_form" method="DELETE" class="form" action="{{ route('users.destroy', $record->id) }}">
    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_add_user_scroll" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-max-height="auto"
        data-kt-scroll-dependencies="#kt_modal_add_user_header" data-kt-scroll-wrappers="#kt_modal_add_user_scroll"
        data-kt-scroll-offset="300px">
            <x-forms.label.index label='Esta seguro que desea eliminar el usuario "{{ $record->name }}" ?' />
    </div>
</form>
