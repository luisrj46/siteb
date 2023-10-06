@php
    $phoneType = \App\Models\Phone\PhoneType::get();
@endphp

<div class="col-md-3">
    <x-forms.input.index type="hidden"  :disabled="$disabled" name="phones[{{$key}}][id]" value="{{ $value?->id }}"></x-forms.input.index>
    <x-forms.input-group.index :disabled="$disabled" :options="$phoneType" variant="select" label="Tipo" :value="$value?->type?->id" required="1"
        name="phones[{{$key}}][phone_type_id]" />
</div>
<div class="col-md-6">
    <x-forms.input-group.index label="Número" :disabled="$disabled" type="number" value="{{ $value?->number }}" required="1"
        name="phones[{{$key}}][number]" />

</div>
