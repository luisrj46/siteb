@props(['id', 'model', 'route', 'records' => [], 'columnsTable' => []])
@php
    $model = new $model();
@endphp
<table id="table_{{ $id }}" column-defs-table={{ $model->configColumnDefs() }}
    columns-table={{ $model->configColumns() }} route={{ $route }}
    class="table table-striped table-row-bordered gy-5 gs-7 display border rounded">
    <thead>
        <tr class="fw-bold fs-6 text-gray-800 px-7">
            @foreach ($model::tableHeaders as $header)
                <td>{{ $header }}</td>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($records as $record)
            <tr>
                @foreach ($model::tableFields as $field)
                    <td>{{ $record->$field }}</td>
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>