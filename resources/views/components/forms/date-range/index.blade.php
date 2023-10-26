@props(['nameStart', 'nameEnd' => false, 'id' => null, 'startDateValue' => false, 'endDateValue' => false, 'single' => false, 'placeholder' => null, 'disabled' => false, 'minDate' => false, 'maxDate' => false, 'opens' => false, 'timePicker' => false])
@php
    use Illuminate\Support\Str;
    use Illuminate\Support\Carbon;
    $id = $id ?? 'id_' . Str::slug($nameStart, '_');
    $configName = 'config_' . Str::slug($nameStart, '_');
@endphp
<div class="mb-0">
    <input class="form-control form-control-solid" @if ($disabled) disabled @endif
        placeholder="{{ $placeholder }}" id="{{ $id }}">
    <input type="hidden" value="{{ $startDateValue }}" @if ($disabled) disabled @endif
        name="{{ $nameStart }}">
    @if (!$single && $nameEnd)
        <input type="hidden" value="{{ $endDateValue }}" @if ($disabled) disabled @endif
            name="{{ $nameEnd }}">
    @endif
</div>
@php
    $startDateValue = $startDateValue ? Carbon::parse($startDateValue)->format('d/m/Y H:i:s') : false;
    $endDateValue = $endDateValue ? Carbon::parse($endDateValue)->format('d/m/Y H:i:s') : false;
    $minDate = $minDate ? Carbon::parse($minDate)->format('d/m/Y H:i:s') : false;
    $maxDate = $maxDate ? Carbon::parse($maxDate)->format('d/m/Y H:i:s') : false;
@endphp

<script>
    formatter = 'DD/MM/YYYY';
    if (@json($timePicker)) {
        formatter = 'DD/MM/YYYY hh:mm A';
    }

    {{ $configName }} = {
        showDropdowns: true,
        linkedCalendars: false,
        locale: {
            format: formatter,
            separator: " - ",
            applyLabel: "Aplicar",
            cancelLabel: "Cancelar",
            fromLabel: "DE",
            toLabel: "HASTA",
            customRangeLabel: "Custom",
            daysOfWeek: [
                "Dom",
                "Lun",
                "Mar",
                "Mie",
                "Jue",
                "Vie",
                "Sáb"
            ],
            monthNames: [
                "Enero",
                "Febrero",
                "Marzo",
                "Abril",
                "Mayo",
                "Junio",
                "Julio",
                "Agosto",
                "Septiembre",
                "Octubre",
                "Noviembre",
                "Diciembre"
            ],
            firstDay: 1,
        },
    }

    if ("{{ $single }}") {
        {{ $configName }}.singleDatePicker = true;
    }
    if (@json($timePicker)) {
        {{ $configName }}.timePicker = true;
    }

    if ("{{ $startDateValue }}") {
        {{ $configName }}.startDate = "{{ $startDateValue }}";
    }
    if ("{{ $endDateValue }}") {
        {{ $configName }}.endDate = "{{ $endDateValue }}"
    }
    if ("{{ $minDate }}") {
        {{ $configName }}.minDate = "{{ $minDate }}"
    }
    if ("{{ $maxDate }}") {
        {{ $configName }}.maxDate = "{{ $maxDate }}"
    }
    if ("{{ $opens }}") {
        {{ $configName }}.opens = "{{ $opens }}";
    }

    setTimeout(() => {
        modalParent = $('.modal.show')[0];
        modalId = null;

        if (modalParent != undefined) {
            modalId = $(modalParent).attr('id')
            {{ $configName }}.parentEl = $(`#${modalId} .modal-body`)
        }
        $('#{{ $id }}').daterangepicker({{ $configName }});

        $('#{{ $id }}').on('apply.daterangepicker', function(ev, picker) {
            if (@json($timePicker)) {
                setDateValues(picker.startDate.format('YYYY-MM-DD HH:mm:00'), picker.endDate.format(
                    'YYYY-MM-DD HH:mm:00'))
            } else {
                setDateValues(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format(
                    'YYYY-MM-DD'))
            }

        });
        $('#{{ $id }}').on('cancel.daterangepicker', function(ev, picker) {
            setDateValues()
            $(this).val('');

        });

        function setDateValues(startDate = null, endDate = null) {
            $("[name={{ $nameStart }}]").val(startDate)
            if ("{{ $nameEnd }}") {
                $("[name={{ $nameEnd }}]").val(endDate)
            }
        }
        if (!"{{ $startDateValue }}") {
            $('#{{ $id }}').val('');
        }
    }, 400);
</script>
