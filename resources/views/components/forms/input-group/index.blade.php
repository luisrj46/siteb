@props([
    'name' => null,
    'type' => 'text',
    'class' => '',
    'value' => null,
    'id' => null,
    'label' => null,
    'required' => false,
    'placeholder' => null,
    'withLabel' => true,
    'offcomplete' => null,
    'readonly' => false,
    'disabled' => false,
    'variant' => 'input',
    'options' => [],
    'checked' => false,
    'labelDelete' => null,
    'labelAdd' => null,
    'body' => null,
    'url' => null,
    'idChild' => null,
    'searchable' => true,
    'idParent' => null,
    'labelFooter' => null,
    'multiple' => false,
    'single' => false,
    'nameEnd' => false,
    'minDate' => false,
    'maxDate' => false,
    'startDateValue' => false,
    'endDateValue' => false,
    'opens' => false,
    'contentCallback' => null,
    'limit' => false,
    'keysValues' => null,
    'empty' => false,
    'timePicker' => false,
    'labelError' => true,
])
@php
    $class =
        [
            'input' => 'form-control-solid mb-lg-0',
        ][$variant] ?? $class;
    $withoutLabel = !in_array($variant, ['checkbox']);
@endphp
<div class="fv-row mb-7">
    @if ($withLabel && $withoutLabel)
        <x-forms.label.index :$label :$required :$placeholder :$contentCallback />
    @endif

    @if ($variant == 'input')
        <x-forms.input.index :$type :$name :$id :$value :$readonly :$disabled :$offcomplete :$class :$placeholder
            :$contentCallback />
    @endif

    @if ($variant == 'textarea')
        <x-forms.textarea.index :$type :$name :$id :$value :$readonly :$disabled :$offcomplete :$class :$placeholder
            :$contentCallback />
    @endif

    @if ($variant == 'select2')
        <x-forms.select2.index :$limit :$idChild :$searchable :$options :$url :$type :$name :$id :$value :$readonly
            :$disabled :$contentCallback :$class :$idParent :$multiple :$placeholder :$keysValues :$empty />
    @endif

    @if ($variant == 'checkbox')
        <x-forms.checkbox.index :$name :$label :$id :$value :$readonly :$disabled :$checked :$class :$placeholder
            :$contentCallback />
    @endif

    @if ($variant == 'image')
        <x-forms.input.image :$name :$label :$id :$value :$readonly :$disabled :$placeholder :$contentCallback /><br>
    @endif

    @if ($variant == 'repeater')
        <x-forms.repeater.repeater :$value :$body :$id :$labelDelete :$labelAdd :$readonly :$disabled :$placeholder
            :$contentCallback />
    @endif

    @if ($variant == 'select')
        <x-forms.select.index :$options :$name :$id :$value :$readonly :$disabled :$class :$placeholder
            :$contentCallback />
    @endif

    @if ($variant == 'date-range')
        <x-forms.date-range.index :$startDateValue :$endDateValue :$minDate :$maxDate :nameStart="$name" :$nameEnd :$id
            :$contentCallback :$single :$readonly :$disabled :$class :$placeholder :$opens :$timePicker />
    @endif

    @if ($variant == 'ckeditor')
        <x-forms.ckeditor.index :$name :$id :$value :$readonly :$disabled :$class :$placeholder :$contentCallback />
    @endif

    @if ($labelFooter)
        <small id="small_{{ $name }}" class="text-muted">{{ $labelFooter }}</small>
    @endif
    @if ($labelError)
        <span id="error_{{ $name }}" class="text-danger d-none"></span>
    @endif

</div>
