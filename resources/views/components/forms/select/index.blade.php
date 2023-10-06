@props(['name', 'options', 'disabled' => false, 'id' => null, 'class' => 'form-select-solid', 'placeholder' => 'Seleccione una opción', 'readonly' => false, 'disabled' => false, 'url' => null, 'idChild' => null, 'searchable' => true,'value' => null])
@php
    use Illuminate\Support\Str;
    $id = $id ?? 'id_' . Str::slug($name, '_');
@endphp

<select id='{{ $id }}'  name="{{ $name }}" url="{{ $url }}" idChild="{{ $idChild }}"
    @if ($readonly) readonly @endif @if ($disabled) disabled @endif
    {{ $attributes->merge(['class' => 'form-select ' . $class]) }}
    data-placeholder="{{ $placeholder }}">
    @foreach ($options as $option)
        <option {{$value == $option->id ? 'selected' : ''}} value="{{ $option->id }}">{{ $option->name }}</option>
    @endforeach
</select>

