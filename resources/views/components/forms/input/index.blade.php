@props(['name', 'id' => null, 'placeholder' => '...', 'class' => 'bg-transparent', 'type' => 'text', 'value' => null, 'offcomplete' => null, 'readonly' => false, 'disabled' => false, 'contentCallback' => false])

@php
    use Illuminate\Support\Str;
    $id = $id ?? 'id_'.Str::slug($name, '_');
@endphp

<input type="{{ $type }}" @if ($contentCallback) contentCallback="{{ $contentCallback }}" @endif
    placeholder="{{ $placeholder }}" id="{{ $id }}" name="{{ $name }}"
    @if ($offcomplete) autocomplete="off" @endif @if ($readonly) readonly @endif
    @if ($disabled) disabled @endif {{ $attributes->merge(['class' => 'form-control ' . $class]) }}
    value="{{ $value }}" />
