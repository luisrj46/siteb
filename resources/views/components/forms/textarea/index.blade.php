@props(['name', 'id'=> null, 'placeholder' => '...', 'class' => 'form-control bg-transparent', 'type' => 'text', 'value' => null, 'offcomplete' => null, 'readonly' => false,'disabled' => false])

@php
    use Illuminate\Support\Str;
    $id = $id ?? Str::slug($name,'_');
@endphp

<textarea placeholder="{{ $placeholder }}" id="id_{{ $id }}" name="{{ $name }}"
    @if ($offcomplete) autocomplete="off" @endif
    @if ($readonly) readonly @endif
    @if ($disabled) disabled @endif
    {{ $attributes->merge(['class' => 'form-control ' . $class]) }} >
    {{ $value }}
</textarea>
