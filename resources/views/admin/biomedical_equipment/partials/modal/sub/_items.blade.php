<div class="col-md-9">
    <x-forms.input.index type="hidden"  :disabled="$disabled" name="items[{{$key}}][id]" value="{{ $value?->id }}"></x-forms.input.index>
    <x-forms.input-group.index label="Item" :labelError="false" :disabled="$disabled" value="{{ $value?->description }}" required="1"
        name="items[{{$key}}][description]" />

</div>
