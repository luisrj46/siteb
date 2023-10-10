@props(['label', 'name', 'id' => null, 'class' => '', 'checked' => false, 'value' => null, 'readonly' => false, 'disabled' => false, 'keyValue' => null])

@php
    use Illuminate\Support\Str;
    $id = $id ?? 'id_' . Str::slug($name, '_');
@endphp
<div @if ($checked || ($value == $keyValue)) checked @endif {{ $attributes->merge(['class' => 'form-check form-check-custom form-check-solid ' . $class]) }} @if ($readonly) readonly @endif>
    <input class="form-check-input" @if ($disabled) disabled @endif  @if ($readonly) readonly @endif type="radio" name="{{$name}}" value="{{ $value }}" id="{{ $id }}"/>

    <label class="form-check-label text-gray-700" for="{{ $id }}">
        {{ $label}}
    </label>
</div>