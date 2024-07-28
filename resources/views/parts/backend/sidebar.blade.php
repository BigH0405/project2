<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Tổng quan
                </a>
                @include('parts.backend.menu_item', [
                    'title' => 'Danh mục sản phẩm',
                    'name' => 'cate',
                ])
                @include('parts.backend.menu_item', [
                    'title' => 'Danh sách sản phẩm',
                    'name' => 'product',
                ])

                @include('parts.backend.menu_item', [
                    'title' => 'Danh mục khuyến mãi',
                    'name' => 'coupons',
                ])

                @include('parts.backend.menu_item', [
                'title' => 'Danh mục Blog',
                'name' => 'blog',
                ])
                @include('parts.backend.menu_item', [
                    'title' => 'Danh sách Blog',
                    'name' => 'cates',
                ])

                @include('parts.backend.menu_item', [
                    'title' => 'Danh sách người dùng',
                    'name' => 'user',
                    ])

                @include('parts.backend.menu_item', [
                    'title' => 'Danh sách nhóm',
                    'name' => 'group',
                    ])





            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Đăng nhập:</div>
            Xin chào: {{!empty($user) ? $user : 'Khách'}}
        </div>
    </nav>
</div>