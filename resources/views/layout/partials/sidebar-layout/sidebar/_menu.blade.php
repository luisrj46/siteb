<!--begin::sidebar menu-->
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">
    <!--begin::Menu wrapper-->
    <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true"
        data-kt-scroll-activate="true" data-kt-scroll-height="auto"
        data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
        data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
        <!--begin::Menu-->
        <div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6" id="#kt_app_sidebar_menu"
            data-kt-menu="true" data-kt-menu-expand="false">
            <!--end:Menu item-->
            <!--begin:Menu item-->
            <div class="menu-item">
                <a class="menu-link" href="#">
                    <span class="menu-icon">{!! getIcon('home-3', 'fs-1') !!}</span>
                    <span class="menu-title">Inicio</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="#">
                    <span class="menu-icon">{!! getIcon('bill', 'fs-1') !!}</span>
                    <span class="menu-title">Equipos biomedicos</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('customers.index') ? 'active' : '' }}"
                    href="#">
                    <span class="menu-icon">{!! getIcon('wallet', 'fs-1') !!}</span>
                    <span class="menu-title">Mantenimientos</span>
                </a>
            </div>
            <div class="menu-item">
                <a class="menu-link" href="{{ route('users.index') }}">
                    <span class="menu-icon">{!! getIcon('profile-user', 'fs-1') !!}</span>
                    <span class="menu-title">Usuarios</span>
                </a>
            </div>
           
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
