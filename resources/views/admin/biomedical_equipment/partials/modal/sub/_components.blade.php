<div class="col-md-3">
    <x-forms.input.index type="hidden"  :disabled="$disabled" name="components[{{$key}}][id]" value="{{ $value?->id }}"></x-forms.input.index>
    <x-forms.input-group.index label="Nombre" :disabled="$disabled" value="{{ $value?->name }}" required="1"
        name="components[{{$key}}][name]" />

</div>
<div class="col-md-3">
    <x-forms.input-group.index label="Marca" :disabled="$disabled" value="{{ $value?->brand }}" required="1"
        name="components[{{$key}}][brand]" />

</div>
<div class="col-md-2">
    <x-forms.input-group.index label="Modelo" :disabled="$disabled" value="{{ $value?->model }}" required="1"
        name="components[{{$key}}][model]" />

</div>
<div class="col-md-2">
    <x-forms.input-group.index label="Serie" :disabled="$disabled" value="{{ $value?->serie }}" required="1"
        name="components[{{$key}}][serie]" />

</div>
