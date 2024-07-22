<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('admin.') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Tổng quan
                </a>
                @include('parts.backend.menu_item', [
                    'title' => 'Sản phẩm',
                    'name' => 'product',
                ])

                @include('parts.backend.menu_item', [
                    'title' => 'Danh sách sản phẩm',
                    'name' => 'cate',
                ])
                @include('parts.backend.menu_item', [
                'title' => 'Blog',
                'name' => 'blog',
                ])


            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Đăng nhập:</div>
            {{-- {{ Auth::user()->name }} --}}
        </div>
    </nav>
</div>