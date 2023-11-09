<x-default-layout>

    @section('title')
        Inicio
    @endsection

    <!--begin::Row-->
    <div class="row g-xl-10 mb-12 mb-xl-10">
        <!--begin::Col-->
        <div class="col-6">
            @include('partials/widgets/cards/_widget-execution')
           
            @include('partials/widgets/cards/_widget-maintenances')
            
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-6">
            @include('partials/widgets/cards/_widget-equipments')
            
            @include('partials/widgets/cards/_widget-users')
        </div>
        <!--end::Col-->
        <!--begin::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <!--end::Row-->

</x-default-layout>
