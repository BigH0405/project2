@include('parts.backend.header')
<div id="layoutSidenav">
    @include('parts.backend.sidebar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="text-center mb-3 mt-3">Thông tin đơn hàng</h1>
                @if (session('msg'))
                <div class="alert alert-success">{{session('msg')}}</div>
                @endif
                @if (session('msg_warning'))
                <div class="alert alert-danger">{{session('msg_warning')}}</div>
                @endif
                @can('create',App\Models\admin\Bill::class)
                <a href="{{route('admin.bills.add')}}" class="btn btn-primary mb-3">Thêm đơn hàng</a>
                @endcan
                <table class="table table-bordered">
                <thead>
            <tr>
                <th>ID</th>
                <th>Mã đơn hàng</th>
                <th>Người mua</th>
                <th>Email</th>
                <th>Số điện thoại</th>
                <th>Giá</th>
                <th>Ghi chú</th>
                <th>Trạng thái</th>
                <th>Sửa|Xóa</th>
            </tr>
        </thead>
        <tbody>
            @if (!empty($bills))
                @foreach($bills as $key => $bill)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $bill->code }}</td>
                        <td>{{ $bill->name }}</td>
                        <td>{{ $bill->email }}</td>
                        <td>{{ $bill->phone }}</td>
                        <td>{{ number_format($bill->price) }}</td>
                        <td>{{ $bill->messege }}</td>
                        <td>
                            <!-- Hiển thị trạng thái -->
                            <form action="{{ route('admin.bills.billsupdateStatus', $bill->id) }}" method="POST" style="display:inline;">
                                @php
                                $status = session("bill_status_{$bill->id}", 'Chờ xác nhận'); // Giá trị mặc định
                            @endphp
                            {{ $status }}
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="return confirm('Bạn có chắc chắn muốn chuyển đổi trạng thái?')">
                                    Cập nhật trạng thái
                                </button>
                            </form>
                        </td>
                        <td>
                            @can('update',App\Models\admin\Bill::class)
                            <a href="{{route('admin.bills.edit',['id' => $bill->id])}}" class="btn btn-warning sm-2">Sửa</a>
                            @endcan
                            @can('delete',App\Models\admin\Bill::class)
                            <a href="{{route('admin.bills.delete',['id' => $bill->id])}}" class="btn btn-danger sm-2" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</a>
                            @endcan
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
                </main>
                @include('parts.backend.footer')

