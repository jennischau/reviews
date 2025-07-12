<div id="sidebar" class="active">
    <div class="sidebar-wrapper active border-end">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="{{ route('admin.index') }}"><img src="{{ asset('admin/images/logo.png') }}" alt="Logo" style="width: 50px; height: 50px;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="fa-solid fa-xmark"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item {{ Route::is('admin.index') ? 'active' : '' }}">
                    <a href="{{ route('admin.index') }}" class='sidebar-link' style="border: 1px solid #435ebe;">
                        <span>Trang chủ</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('index') ? 'active' : '' }}">
                    <a href="{{ route('index') }}" class='sidebar-link' style="border: 1px solid #435ebe;">
                        <span>Trang review</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('admin.user.index') ? 'active' : '' }} " >
                    <a href="{{ route('admin.user.index') }}" class='sidebar-link' style="border: 1px solid #435ebe;">
                        <span>Người dùng</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Route::is('admin.bank') ? 'active' : '' }} " >
                    <a href="{{ route('admin.bank') }}" class='sidebar-link' style="border: 1px solid #435ebe;">
                        <span>Ngân hàng</span>
                    </a>
                </li>
    </div>
</div>
