@props(['id', 'value' => [], 'body', 'labelAdd' => 'Agregar', 'labelDelete' => 'Eliminar', 'readonly' => false, 'disabled' => false])
@php
    use Illuminate\Support\Collection;
@endphp
<div id="{{ $id }}">
    <!--begin::Form group-->
    <div class="form-group mx-2 ">
        <div data-repeater-list="{{ $id }}">
            @foreach ($value as $key => $val)
                <div class="form-group old align-middle  row">
                    @include($body, [
                        'value' => $val,
                        'key' => random_int(100, 10000) + $key,
                        'disabled' => $disabled,
                    ])
                    <div class="col-md-2 position-relative">
                        <a @if ($disabled) disabled @endif href="javascript:;" repeater-delete="old"
                            class="btn btn-sm position-absolute top-0 end-0 btn-light-danger mt-3 mt-md-8 @if ($disabled) disabled @endif">
                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span><span class="path4"></span><span
                                    class="path5"></span></i>
                            {{ $labelDelete }}
                        </a>
                    </div>
                </div>
            @endforeach

            <div data-repeater-item>
                <div class="form-group align-middle row">
                    @include($body, ['value' => null, 'key' => 0, 'disabled' => $disabled])
                    <div class="col-md-2 position-relative">
                        <a href="javascript:;" data-repeater-delete
                            class="btn btn-sm btn-light-danger position-absolute top-0 end-0 mt-3 mt-md-8 @if ($disabled) disabled @endif">
                            <i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span
                                    class="path2"></span><span class="path3"></span><span class="path4"></span><span
                                    class="path5"></span></i>
                            {{ $labelDelete }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Form group-->
    <!--begin::Form group-->
    <div class="form-group mt-5">
        <a href="javascript:;" data-repeater-create
            class="btn btn-sm btn-light-primary @if ($disabled) disabled @endif">
            <i class="ki-duotone ki-plus fs-3"></i>
            {{ $labelAdd }}
        </a>
    </div>
    <!--end::Form group-->
</div>
<!--end::Repeater-->
<script>
    setTimeout(() => {
        $("#{{ $id }}").repeater({
            initEmpty: true,
            show: function() {
                $(this).slideDown();
                executeCallback(this)
            },
            hide: function(deleteElement) {
                $(this).slideUp(deleteElement);
            }
        });
        $('[repeater-delete="old"]').on('click', function() {
            $(this).closest('.old').remove();
        })

        function executeCallback(DIV) {

            elements = $(DIV).find("[contentCallback]")
            elements.each(function() {
                element = $(this);
                idElement = element.attr('id')+Math.floor(Math.random() * 10000);
                element.attr('id',idElement)
                nameCallback = 'nameCallback' + Math.floor(Math.random() * 10000);
                contentCallback = element.attr('contentCallback');
                if(element.attr('data-kt-image-input')){
                    contentCallback = `new KTImageInput(document.querySelector('#${idElement}'));`
                }
                nameCallback = new Function(contentCallback)
                nameCallback()
            });

        }
    }, 1200);
</script>
