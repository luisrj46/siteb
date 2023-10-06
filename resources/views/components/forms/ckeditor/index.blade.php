@props(['name', 'disabled' => false, 'value' => null])
@php
    use Illuminate\Support\Str;
    $id = $id ?? 'id_' . Str::slug($name, '_');
    $id_toolbar = $id . '_document_toolbar';
    $id_document = $id . '_ckeditor_document';
    $id_textarea = $id . '_textarea';
@endphp

<div id="{{ $id_toolbar }}"></div>
<div class="border border-secondary" id="{{ $id_document }}">
</div>
<textarea name="{{ $name }}" class="d-none" id="{{ $id_textarea }}">{!! $value !!}</textarea>
<script>
    setTimeout(() => {
        const editor = DecoupledEditor
            .create(document.querySelector("#{{ $id_document }}")
            )
            .then(editor => {
                const toolbarContainer = document.querySelector("#{{ $id_toolbar }}");
                toolbarContainer.appendChild(editor.ui.view.toolbar.element);

                // Agregar evento on change al editor
                editor.model.document.on('change:data', () => {
                    const updatedContent = editor.getData();
                    $("#{{ $id_textarea }}").text(updatedContent);
                });

                editor.setData($("#{{ $id_textarea }}").val());
            })
            .catch(error => {
                console.error(error);
            });

    }, 1500);
</script>
