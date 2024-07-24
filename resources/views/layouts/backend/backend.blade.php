        @include('parts.backend.header')
        <div id="layoutSidenav">
        @include('parts.backend.sidebar')
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        @include('parts.backend.page_title')
                        <h1 class="text-center">Trang chủ Admin</h1>
                    </div>
                </main>
                    @include('parts.backend.footer')
            </div>
