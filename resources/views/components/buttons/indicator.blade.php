@props(['id', 'label', 'type' => 'submit', 'class' => 'btn-primary'])

<button type="{{ $type }}" id="{{ $id }}" {{ $attributes->merge(['class' => 'btn ' . $class]) }}>
    <!--begin::Indicator label-->
    <span class="indicator-label">
        {{ $label}}
    </span>
    <!--end::Indicator label-->
    <!--begin::Indicator progress-->
    <span class="indicator-progress">Por favor espere...
        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
    <!--end::Indicator progress-->
</button>