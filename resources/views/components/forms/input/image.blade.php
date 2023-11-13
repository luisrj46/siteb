@props(['name', 'label', 'id' => null, 'value' => null, 'readonly' => false, 'disabled' => false, 'contentCallback' => null])
@php
    use Illuminate\Support\Str;
    $id = $id ?? Str::slug($name, '_');
    $label = strtolower($label);
@endphp

<!--end::Image input-->
<style>
    .image-input-placeholder {
        background-image: url('{{ image('svg/files/blank-image.svg') }}');
    }

    [data-bs-theme="dark"] .image-input-placeholder {
        background-image: url('{{ image('svg/files/blank-image-dark.svg') }}');
    }
</style>

<!--begin::Image input-->
<div class="image-input image-input-outline" @if ($contentCallback) contentCallback="{{ $contentCallback }}" @endif id="{{ $id }}" data-kt-image-input="true"
    style="background-image: url(/assets/media/svg/avatars/blank.svg)">
    @if ($value)
        <div class="image-input-wrapper w-125px h-125px" style="background-image: url('{{ $value }}');"></div>
    @else
        <div class="image-input-wrapper w-125px h-125px image-input-placeholder"></div>
    @endif
    <!--begin::Edit button-->
    <label
        class="btn @if ($disabled) disabled @endif btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
        data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click"
        title="Cambiar {{ $label }}">
        <i class="ki-duotone ki-pencil fs-6"><span class="path1"></span><span class="path2"></span></i>

        <!--begin::Inputs-->
        <input type="file" data-id="{{ $id }}" name="{{ $name }}" accept="image/*" />
        <input type="hidden" name="{{ $name }}_remove" />
        <!--end::Inputs-->
    </label>
    <!--end::Edit button-->

    <!--begin::Cancel button-->
    <span class="btn btn-icon btn-circle @if ($disabled) disabled @endif" btn-color-muted
        btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel"
        data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancelar {{ $label }}">
        <i class="ki-outline ki-cross fs-3"></i>
    </span>
    <!--end::Cancel button-->

    <!--begin::Remove button-->
    <span
        class="btn btn-icon btn-circle @if ($disabled) disabled @endif btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow"
        data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click"
        title="Eliminar {{ $label }}">
        <i class="ki-outline ki-cross fs-3"></i>
    </span>
    <!--end::Remove button-->
</div>

<script>
    new KTImageInput(document.querySelector("#{{ $id }}"));
</script>
