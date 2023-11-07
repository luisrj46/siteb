<!--begin::Navbar-->
@push('styles')
    <style>
        .select2-container--bootstrap5 .select2-selection__clear {
            display: block;
            height: 0.7rem;
            width: 0.7rem;
            top: 50%;
            right: 0.5rem;
            position: absolute;
            transform: translateY(-50%);
            background-color: var(--bs-gray-700) !important;
        }

        .form-select {
            --bs-form-select-bg-img: none,
                display: block;
            width: 100%;
            padding: 0.775rem 1.2rem 0.775rem 1rem;
            -moz-padding-start: calc(1rem - 3px);
            font-size: 1.1rem;
            font-weight: 500;
            line-height: 1.5;
            color: var(--bs-gray-700);
            background-color: var(--bs-body-bg);
            background-image: var(--bs-form-select-bg-img), var(--bs-form-select-bg-icon, none);
            background-repeat: no-repeat;
            background-position: right 1rem center;
            background-size: 16px 12px;
            border: 1px solid var(--bs-gray-300);
            border-radius: 0.475rem;
            box-shadow: false;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
    </style>
@endpush
<div class="app-navbar flex-shrink-0">
    <!--begin::Notifications-->
    <div class="app-navbar-item ms-1 ms-md-4">
        <!--begin::Menu- wrapper-->
        <div class="btn m-2 btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary w-40px h-40px "
            data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
            data-kt-menu-placement="bottom-end" id="kt_menu_item_wow">{!! getIcon('notification', 'fs-2') !!}
            @if ($authUser->unreadNotifications->count() > 0)
                <span class="text-danger bg-white p-1 border translate-middle top-0 start-50 animation-blink">{{ $authUser->unreadNotifications->count() }}</span>
            @endif
        </div>
        @include('partials.menus._notifications-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--begin::User menu-->
    <div class="app-navbar-item symbol-40px ms-5 cursor-pointer symbol text-white symbol-35px"
        id="kt_header_user_menu_toggle" data-kt-menu-trigger="{default: 'click', lg: 'hover'}"
        data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        <!--begin::Menu wrapper-->
        <div class="symbol symbol-40px ">
            @if ($authUser->photo_access)
                <img src="{{ $authUser->photo_access }}" class="avatar rounded-3" alt="user" />
            @else
                <div
                    class="symbol-label fs-3 {{ app(\App\Actions\GetThemeType::class)->handle('bg-light-? text-?') }}">
                    {{ substr($authUser->name, 0, 1) }}
                </div>
            @endif
        </div>
        @include('partials/menus/_user-account-menu')
        <!--end::Menu wrapper-->
    </div>
    <!--end::User menu-->
</div>
<!--end::Navbar-->
