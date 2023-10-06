@props(['id', 'static' => false, 'size' => 'md'])
@php
    $sized = ['md' => '', 'sm' => 'modal-sm', 'lg' => 'modal-lg', 'xl' => 'modal-xl'][$size];
@endphp
<div class="modal fade" id="{{ $id }}" @if ($static) data-bs-backdrop="static" @endif
    tabindex="-1" aria-hidden="true">
    <div class="modal-dialog {{ $sized }} modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold" id="_title">{{ $title ?? '' }}</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    {!! getIcon('cross', 'fs-1') !!}
                </div>
            </div>
            <div id="_body" class="modal-body px-5 my-7">
                {{ $slot }}
            </div>
            @if ($footer ?? false)
                <div id="_footer" class="modal-footer">
                    {{ $footer ?? '' }}
                </div>
            @endif
        </div>
    </div>
</div>
