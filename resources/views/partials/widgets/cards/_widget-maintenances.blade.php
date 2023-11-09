<!--begin::Card widget 20-->
<div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end mb-5 mb-xl-10"
    style="background-color: #77d4fc;">
    <!--begin::Header-->
    <h2 class="text-center pt-3">Mantenimientos</h2>
    <div class="card-header pt-1">
        <!--begin::Title-->
        <div class="card-title d-flex flex-column">
            <!--begin::Amount-->
            <span class="fs-2hx fw-bold me-2 lh-1 ls-n2">{{ $result->maintenance?->total }}</span>
            <!--end::Amount-->
            <!--begin::Subtitle-->
            <span class="opacity-75 pt-1 fw-semibold fs-6">Total</span>
            <!--end::Subtitle-->
        </div>
        <!--end::Title-->
    </div>
    <div class="card-header pt-2">
        <!--begin::Title-->
        <div class="card-title d-flex flex-column">
            <!--begin::Amount-->
            <span class="fs-1hx fw-bold me-2 lh-1 ls-n2">{{ $result->maintenance?->preventive }}</span>
            <!--end::Amount-->
            <!--begin::Subtitle-->
            <span class="opacity-75 pt-1 fw-semibold fs-6">Preventivos</span>
            <!--end::Subtitle-->
        </div>
        <!--end::Title-->
    </div>
    <div class="card-header pt-2">
        <!--begin::Title-->
        <div class="card-title d-flex flex-column">
            <!--begin::Amount-->
            <span class="fs-1hx fw-bold me-2 lh-1 ls-n2">{{ $result->maintenance?->corrective }}</span>
            <!--end::Amount-->
            <!--begin::Subtitle-->
            <span class="opacity-75 pt-1 fw-semibold fs-6">Correctivos</span>
            <!--end::Subtitle-->
        </div>
        <!--end::Title-->
    </div>
    <!--end::Header-->
</div>
<!--end::Card widget 20-->
