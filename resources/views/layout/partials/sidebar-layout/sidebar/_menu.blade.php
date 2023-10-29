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
                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                 href="{{ route('dashboard') }}">
                    <span class="menu-icon">{!! getIcon('home-3', 'fs-1') !!}</span>
                    <span class="menu-title">Inicio</span>
                </a>
            </div>
            @can('viewAny', \App\Models\BiomedicalEquipment\BiomedicalEquipment::class)
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('biomedicalEquipments.index') ? 'active' : '' }}" 
                    href="{{ route('biomedicalEquipments.index') }}">
                        <span class="menu-icon">{!! getIcon('bill', 'fs-1') !!}</span>
                        <span class="menu-title">Equipos biomedicos</span>
                    </a>
                </div>
            @endcan
            @can('viewAny', \App\Models\Maintenance\Maintenance::class)
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('maintenances.index') ? 'active' : '' }}"
                        href="{{ route('maintenances.index') }}">
                        <span class="menu-icon">{!! getIcon('wallet', 'fs-1') !!}</span>
                        <span class="menu-title">Mantenimientos</span>
                    </a>
                </div>
            @endcan
            @can('viewAny', \App\Models\User\User::class)
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('users.index') ? 'active' : '' }}"
                        href="{{ route('users.index') }}">
                        <span class="menu-icon">{!! getIcon('profile-user', 'fs-1') !!}</span>
                        <span class="menu-title">Usuarios</span>
                    </a>
                </div>
            @endcan
            {{-- @can('viewAny', \App\Models\User\User::class) --}}
                <div class="menu-item">
                    <a class="menu-link {{-- {{ request()->routeIs('users.index') ? 'active' : '' }} --}}"
                        href="{{ route('maintenances.calendar') }}">
                        <span class="menu-icon">{!! getIcon('profile-user', 'fs-1') !!}</span>
                        <span class="menu-title">Agenda</span>
                    </a>
                </div>
            {{-- @endcan --}}
        </div>
        <!--end::Menu-->
    </div>
    <!--end::Menu wrapper-->
</div>
<!--end::sidebar menu-->
