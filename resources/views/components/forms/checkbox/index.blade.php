@props(['label', 'name', 'id' => null, 'class' => '', 'checked' => false, 'value' => null, 'readonly' => false, 'disabled' => false])

@php
    use Illuminate\Support\Str;
    $id = $id ?? 'id_' . Str::slug($name, '_');
@endphp

<div {{ $attributes->merge(['class' => 'form-check' . $class]) }}>
    <input @if ($checked || $value) checked @endif @if ($readonly) readonly @endif
        @if ($disabled) disabled @endif class="form-check-input" type="checkbox"
        id="{{ $id }}" />
    <input name="{{ $name }}" @if ($readonly) readonly @endif
        @if ($disabled) disabled @endif type="hidden" value="{{ ($checked || $value) ? 1 : 0 }}" />
    <label class="form-check-label" for="{{ $id }}">
        {{ $label }}
    </label>
</div>
<script>
    $("#{{ $id }}").on('change', function() {
        if (this.checked) {
            $("[name='{{ $name }}']").val(1);
        } else {
            $("[name='{{ $name }}']").val(0);
        }
    });
</script>
