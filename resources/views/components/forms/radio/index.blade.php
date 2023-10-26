@props([
    'label',
    'name',
    'class' => '',
    'checked' => false,
    'value' => null,
    'readonly' => false,
    'disabled' => false,
    'keyValue' => null,
    'keyName' => null,
])

@php
    use Illuminate\Support\Str;
    $id = $id ?? 'id_' . Str::slug($name, '_') . rand();
    $keyName = $keyName ?? Str::slug($name, '_');
    $aux = Str::slug($name, '');
@endphp
<div {{ $attributes->merge(['class' => 'form-check form-check-custom form-check-solid ' . $class]) }}
    @if ($readonly) readonly @endif>
    <input class="form-check-input" @if ($checked || $value == $keyValue) checked @endif aux="{{ $aux }}"
        @if ($disabled) disabled @endif @if ($readonly) readonly @endif
        type="radio" name="{{ $name }}" value="{{ $value }}" id="{{ $id }}" />

    <input type="hidden" name="{{ $name }}" class="{{ $aux }}">

    <label class="form-check-label text-gray-700" for="{{ $id }}">
        {{ $label }}
    </label>
</div>
<script>
    if (document.querySelectorAll(".{{ $aux }}").length > 1) document.querySelector(".{{ $aux }}")
        .remove();

    setTimeout(() => {
        $("[name^={{ $keyName }}]").on('change', function() {
            $("." + $(this).attr('aux')).remove()
        });

        if (@json($checked) || @json($value == $keyValue)) {
            $(".{{$aux}}:hidden").remove()
        }

    }, 2000);
</script>
