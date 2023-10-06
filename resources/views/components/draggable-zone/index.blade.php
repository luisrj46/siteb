@props(['name', 'id'])
@php
use Illuminate\Support\Str;
$id = $id ?? 'id_' . Str::slug($name, '_');
@endphp

<div class="row row-cols-lg-2 g-10 draggable-zone" name="{{ $name }}" id="{{ $id }}">
    {{ $slot }}
</div>

@push('scripts')
<script>
    var containers = document.querySelectorAll(".draggable-zone");

        if (containers.length === 0) {
            return false;
        }

        var swappable = new Sortable.default(containers, {
            draggable: ".draggable",
            handle: ".draggable .draggable-handle",
            mirror: {
                //appendTo: selector,
                appendTo: "body",
                constrainDimensions: true
            }
        });
        
</script>
@endpush