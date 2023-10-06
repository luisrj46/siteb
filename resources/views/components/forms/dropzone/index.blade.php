@props(['name', 'label', 'id' => null, 'value' => null, 'readonly' => false, 'disabled' => false, 'url' =>
'public/$pathRoot'])
@php
use Illuminate\Support\Str;
$id = $id ?? Str::slug($name, '_');
$label = strtolower($label);
@endphp
<!--begin::Form-->
<form class="form" action="#" method="post">
    <!--begin::Input group-->
    <div class="fv-row">
        <!--begin::Dropzone-->
        <div class="dropzone" id="{{ $id }}">
            <!--begin::Message-->
            <div class="dz-message needsclick">
                <i class="ki-duotone ki-file-up fs-3x text-primary"><span class="path1"></span><span
                        class="path2"></span></i>

                <!--begin::Info-->
                <div class="ms-4">
                    <h3 class="fs-5 fw-bold text-gray-900 mb-1">Seleccione una o mas imagenes</h3>
                    <span class="fs-7 fw-semibold text-gray-400">JPG, PNG or PDF, filesize no more than 10MB</span>
                </div>
                <!--end::Info-->
            </div>
        </div>
        <!--end::Dropzone-->
    </div>
    <!--end::Input group-->
</form>
<!--end::Form-->
<script>
    var myDropzone = new Dropzone("#{{ $id }}", {
        url: "https://keenthemes.com/scripts/void.php",
        paramName: "{{ $name }}",
        maxFiles: 10,
        maxFilesize: 10, // MB
        addRemoveLinks: true,
        accept: function(file, done) {
            if (file.name == "wow.jpg") {
                done("Naha, you don't.");
            } else {
                done();
            }
        }
    });
</script>