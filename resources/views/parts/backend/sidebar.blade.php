<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('admin.index') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Tổng quan
                </a>
                @can('product_category')
                @include('parts.backend.menu_item', [
                    'title' => 'Danh mục sản phẩm',
                    'name' => 'cate',
                ])
                @endcan

                @can('products')
                @include('parts.backend.menu_item', [
                    'title' => 'Danh sách sản phẩm',
                    'name' => 'product',
                ])
                @endcan

               @can('coupons')
               @include('parts.backend.menu_item', [
                    'title' => 'Danh mục khuyến mãi',
                    'name' => 'coupons',
                    ])
               @endcan

                @can('blog_category')
                @include('parts.backend.menu_item', [
                    'title' => 'Danh mục Blog',
                    'name' => 'cates',
                    ])
                @endcan

                @can('blogs')
                @include('parts.backend.menu_item', [
                    'title' => 'Danh sách Blog',
                    'name' => 'blog',
                    ])
                @endcan

                @can('users')
                @include('parts.backend.menu_item', [
                    'title' => 'Danh sách người dùng',
                    'name' => 'user',
                    ])
                @endcan

                @can('groups')
                @include('parts.backend.menu_item', [
                    'title' => 'Danh sách nhóm',
                    'name' => 'group',
                    ])
                @endcan
                
                @can('contacts')
                @include('parts.backend.menu_item', [
                    'title' => 'Quản lý liên hệ',
                    'name' => 'contacts',
                    ])   
                @endcan
                
                @can('comments')
                @include('parts.backend.menu_item', [
                    'title' => 'Bình luận',
                    'name' => 'comments',
                    ])
                @endcan

                @can('reviews')
                @include('parts.backend.menu_item', [
                    'title' => 'Đánh giá ',
                    'name' => 'reviews',
                    ])  
                @endcan
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Đăng nhập:</div>
            Xin chào: {{!empty($user) ? $user : 'Khách'}}
        </div>
    </nav>
</div>