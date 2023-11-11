<!--begin::Menu-->
<div class="menu menu-sub menu-sub-dropdown menu-column w-350px w-lg-375px" data-kt-menu="true" id="kt_menu_notifications">
    <div class="d-flex flex-column bg-light-primary bgi-no-repeat rounded-top">
        <h3 class=" fw-semibold px-9 mt-5 mb-2">Notificaciones ({{ $authUser->unreadNotifications->count() }})</h3>
    </div>
    <div class="tab-content">
        <div class="scroll-y mh-325px my-5 px-8">
            @foreach ($authUser->unreadNotifications as $notification)
                @php
                    $class = $notification->data['class'] . ' fs-1';
                @endphp
                <div data-route="{{$notification->data['class']}}" class="d-flex read-notification cursor-pointer flex-stack py-4">
                    <a href="{{$notification->data['route']}}" class="text-dark opacity-75">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-35px me-4">
                                <span class="symbol-label bg-light-primary">{!! getIcon($notification->data['icon'], $class) !!}</span>
                            </div>
                            <div class="mb-0 me-2">
                                {{ $notification->data['message'] }}
								<br>
								<div class="text-gray-600 fs-7">{{ now()->diffForHumans($notification->created_at) }}</div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
