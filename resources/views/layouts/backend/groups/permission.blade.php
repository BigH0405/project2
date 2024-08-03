
@include('parts.backend.header')
<div id="layoutSidenav">
    @include('parts.backend.sidebar')
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                    <h1 class="text-center mb-3 mt-3">{{ 'Phân quyền nhóm: ' . $group->name }}</h1>
                    @if (session('msg'))
                    <div class="alert alert-success">{{ session('msg') }}</div>
                @endif
                @if (session('msg_warning'))
                    <div class="alert alert-danger">{{ session('msg_warning') }}</div>
                @endif
                @if ($errors->any())
                <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu</div>
                @endif
                <form action="" method="POST">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="20%">Module</th>
                                <th>Quyền</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($module as $mod)
                                <tr>
                                    <td>{{ $mod->title }}</td>
                                    <td>
                                        <div class="row">
                                            @foreach ($roleListArr as $roleName => $roleLabel)
                                                <div class="col-2">
                                                    <label for="role_{{ $mod->name }}_{{ $roleName }}">
                                                        <input type="checkbox" name="role[{{ $mod->name }}][]" id="role_{{ $mod->name }}_{{ $roleName }}" value="{{ $roleName }}" {{ isset($roleArr[$mod->name]) && in_array($roleName, $roleArr[$mod->name]) ? 'checked' : '' }}>
                                                        {{ $roleLabel }}
                                                    </label>
                                                </div>
                                            @endforeach
                        
                                            @if ($mod->name == 'groups')
                                                <div class="col-3">
                                                    <label for="role_{{ $mod->name }}_permission">
                                                        <input type="checkbox" name="role[{{ $mod->name }}][]" id="role_{{ $mod->name }}_permission" value="permission" {{ isset($roleArr[$mod->name]) && in_array('permission', $roleArr[$mod->name]) ? 'checked' : '' }}>
                                                        Phân quyền
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                                          
                    </table>
                    <button class="btn btn-primary">Phân quyền</button>
                    @csrf
                </form>
            </div>
        </div>
        </div>
        </div>
        </main>
        @include('parts.backend.footer')
