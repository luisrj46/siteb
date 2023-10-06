@props(['name', 'options' => [], 'disabled' => false, 'id' => null, 'class' => 'form-select-solid', 'placeholder' => 'Seleccione una opción', 'readonly' => false, 'disabled' => false, 'url' => null, 'idChild' => null, 'searchable' => true, 'value' => null, 'idParent' => null, 'multiple' => false, 'limit' => false, 'keysValues' => 'name', 'init' => true, 'empty' => false])
@php
    use Illuminate\Support\Str;
    $id = $id ?? 'id_' . Str::slug($name, '_');
    $keysValues = explode('|', $keysValues);
@endphp

<select id='{{ $id }}' @if ($limit) limit="{{ $limit }}" @endif
    name="{{ $name }}" url="{{ $url }}" idParent="{{ $idParent }}" idChild="{{ $idChild }}"
    @if ($readonly) readonly @endif @if ($multiple) multiple @endif
    @if ($disabled) disabled @endif {{ $attributes->merge(['class' => 'form-select ' . $class]) }}
    data-control="select2" data-placeholder="{{ $placeholder }}">
    @if ($value && !is_iterable($value) && !count($options))
        <option selected="selected" value="{{ $value->id }}">
            @foreach ($keysValues as $key => $name)
                {{ $key > 0 ? '-' : null }}
                {{ $value->$name }}
            @endforeach
        </option>
    @endif
    @if ($value && is_iterable($value) && !count($options))
        @foreach ($value as $valu)
            <option selected="selected" value="{{ $valu->id }}">
                @foreach ($keysValues as $key => $name)
                    {{ $valu->$name }}
                    {{ $key > 0 ? '-' : null }}
                @endforeach
            </option>
        @endforeach
    @endif
    @if ($empty)
        <option selected disabled value="">{{ $placeholder }}</option>
    @endif
    @foreach ($options as $option)
        <option {{ $option->id == $value ? 'selected="selected"' : ''}}  value="{{ $option->id }}">{{ $option->name }}</option>
    @endforeach
</select>

<script>
    if (@json($init)) {

        setTimeout(() => {

            config = {}
            modalParent = $('.modal.show')[0];
            modalId = null;

            if (modalParent != undefined) {
                modalId = $(modalParent).attr('id')
                config.dropdownParent = $(`#${modalId} .modal-body`)
            }

            if (!{{ $searchable }}) {
                config.minimumResultsForSearch = -1;
            }

            if ("{{ $url }}" != '') {
                $("#{{ $id }}").select2({
                    ajax: {
                        url: "{{ $url }}",
                        delay: 250,
                        dataType: 'json',
                        data: function(params) {
                            var query = {
                                term: params.term,
                                model: $(this).attr('idParent'),
                                limit: $(this).attr('limit') ?? 15,
                            }
                            return query;
                        },
                    },
                    dropdownParent: config.dropdownParent,
                    minimumResultsForSearch: config.minimumResultsForSearch,
                    cache: true
                }).on("select2:select", function(e) {

                    if ($(this).attr('idChild') != '') {
                        let selected_element = $(e.currentTarget);
                        let select_val = selected_element.val();
                        $('#' + $(this).attr('idChild')).val(null).trigger('change');
                        $('#' + $(this).attr('idChild')).attr('idParent', select_val)
                    }
                })
                return;
            } else {
                $("#{{ $id }}").select2(config);
            }


        }, 400);
    }
</script>
