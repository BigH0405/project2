@include('parts.backend.header')
<div id="layoutSidenav">
    @include('parts.backend.sidebar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="text-center mb-3 mt-3">{{$title}}</h1>
                @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
                @endif
                @if (session('msg_warning'))
                <div class="alert alert-danger">{{session('msg_warning')}}</div>
                @endif
                <a href="{{route('admin.contacts.index')}}" class="btn btn-warning mb-3">Quay về</a>
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <label for="fullname">Họ và tên</label>
                            <input type="text" name="fullname" class="form-control" placeholder="Nhập tên sản phẩm..." value="{{ old('fullname') ?? $contacts->fullname }}">
                            @error('name')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="email">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Nhập email" value="{{ old('email') ?? $contacts->email }}">
                            @error('email')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="phone">Số điện thoại </label>
                            <input type="text" name="phone" class="form-control" placeholder="Nhập số lượng..." value="{{ old('phone') ?? $contacts->phone }}">
                            @error('phone')
                            <span style="color: red">{{$message}}</span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <label for="user_id">user_id</label>
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach ($allUser as $item)
                                    <option value="{{ $item->id }}" {{ old('user_id') == $item->id || $contacts->user_id == $item->id ? 'selected' : '' }}>
                                        {{ $item->fullname }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col">
                            <label for="message">message</label>
                            <textarea name="message" cols="12" rows="8" class="form-control">{{ old('message') ?? $contacts->message }}</textarea>
                            @error('message')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-success" type="submit">Cập nhật</button>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        @include('parts.backend.footer')
    </div>
</div>
