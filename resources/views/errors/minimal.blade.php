@extends('layout.master')
@push('styles')
    <style>
        body {
            background-image: url('{{ image('auth/bg8.jpg') }}');
        }
    </style>
@endpush
@section('content')
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-center flex-column-fluid">
            <!--begin::Content-->
            <div class="d-flex flex-column flex-center text-center p-10">
                <!--begin::Card-->
                <div class="card card-flush w-lg-650px py-5">
                    <!--begin::Card body-->
                    <div class="card-body py-15 py-lg-2 text-gray-900 mb-4">
                        <h1 class="display-2">
                            Error @yield('code')
                        </h1>
                        <div class="fw-semibold text-gray-500 mb-7">
                                <h4>@yield('message')</h4>
                        </div>
                        <div class="mb-11">
                            <img src="{{ image('error/errors.jpg') }}" class="mw-100 mh-300px theme-light-show"
                                alt="" />
                        </div>
                        <div class="mb-0">
                            <a href="/" class="btn fs-2  btn-sm btn-primary">Inicio</a>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Root-->
@endsection

{{-- @yield('code')
                        @yield('message') --}}
