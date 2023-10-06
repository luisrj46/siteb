<x-default-layout>

    @section('title')
        Dashboard
    @endsection

    <!--begin::Row-->
    <div class="row g-xl-10 mb-12 mb-xl-10">
        <!--begin::Col-->
        <div class="col-6">
            @include('partials/widgets/cards/_widget-20')

            @include('partials/widgets/cards/_widget-7')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-6">
            @include('partials/widgets/cards/_widget-17')

            @include('partials/widgets/lists/_widget-26')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <!--end::Row-->

</x-default-layout>
