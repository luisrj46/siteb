<button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
@canany(['store', 'update', 'execution'], $record)
    @if ($request->action == 'create' || $request->action == 'edit' || $request->action == 'execution')
        <x-buttons.indicator id="id_btn_send_user" onclick="Maintenance.sendForm(this)"
            label="{{ $request->action == 'execution' || $request->action == 'create' ? 'Guardar' : 'Editar' }}" />
    @endif
@endcanany
@can('delete', $record)
    @if ($request->action == 'delete')
        <x-buttons.indicator id="id_btn_send_user" class="btn-danger" onclick="Maintenance.sendForm(this)" label="Eliminar" />
    @endif
@endcan
