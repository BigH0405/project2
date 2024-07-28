
@include('parts.backend.header')
<div id="layoutSidenav">
    @include('parts.backend.sidebar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="text-center mb-3 mt-3">{{ $title }}</h1>
                @if (session('msg_warning'))
                    <div class="alert alert-danger">{{ session('msg_warning') }}</div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu</div>
                @endif
                <a href="{{ route('admin.group.index') }}" class="btn btn-warning mb-3">Quay về</a>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="">Tên</label>
                            <input type="text" name="name" class="form-control"
                                placeholder="Nhập họ và tên..." value="{{ old('name') }}">
                            @error('name')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="">Quyền hành</label>
                            <input type="text" name="permissions" class="form-control" placeholder="Nhập permissions..."
                                value="{{ old('permissions') }}">
                            @error('permissions')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-success" type="submit">Thêm mới</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        </div>
        </div>
        </main>
        @include('parts.backend.footer')
