@can('delete', $record)
    <i title="Eliminar" onclick="User.openForm(this)" data-action="delete" data-modal-size="md"
        data-route="{{ route('users.show', [$record]) }}"
        class="bi cursor-pointer fs-2 text-danger bi-trash3 me-1 data-modal-app"></i>
@endcan
@can('update', $record)
    <i title="Editar" onclick="User.openForm(this)" data-action="edit" data-route="{{ route('users.edit', [$record]) }}"
        class="bi cursor-pointer fs-2 text-primary bi-pencil-square me-1 data-modal-app"></i>
@endcan
@can('view', $record)
    <i title="Ver" onclick="User.openForm(this)" data-action="view" data-route="{{ route('users.show', [$record]) }}"
        class="bi cursor-pointer fs-2 dark bi-eye-fill data-modal-app"></i>
@endcan
