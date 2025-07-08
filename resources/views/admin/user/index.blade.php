@extends('admin.layout.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Danh sách người dùng</h3>
                {{-- <a href="{{ route('admin.type.insert') }}" class="btn btn-primary">Thêm website</a> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Danh sách người dùng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TÊN</th>
                            <th>EMAIL</th>
                            <th>CẤP BẬC</th>
                            <th>SỐ DƯ</th>
                            <th>TỔNG TIỀN NẠP</th>
                            <th>XỬ LÝ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td >
                                    <form action="{{ route('admin.user.updateLevel', ['id' => $user->id]) }}" method="POST">
                                        @csrf
                                        <select name="level" onchange="this.form.submit()" class="form-select form-select-sm">
                                            <option value="user" {{ $user->level == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="reviewer" {{ $user->level == 'reviewer' ? 'selected' : '' }}>Reviewer</option>
                                            <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>

                                </td>
                                <td>{{ $user->balance }}</td>
                                <td>{{ $user->total_deposit }}</td>
                                <td>
                                    {{-- <a href="{{ route('admin.type.update',['id' => $user->id]) }}" class="btn badge bg-success">Cập nhật</a> --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#typeWebsite{{ $user->id }}">
                                        Xoá
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="typeWebsite{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Xoá loại website</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Bạn có muốn xoá loại website này không?
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                            {{-- <form action="{{ route('admin.type.delete',['id' => $user->id]) }}" method="GET">
                                                @csrf
                                                    <button type="submit" class="btn btn-danger">Xoá</button>
                                            </form> --}}
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
<script>
    // Tự động ẩn alert sau 5 giây
    document.addEventListener('DOMContentLoaded', function () {
        setTimeout(function () {
            let alerts = document.querySelectorAll('.alert');
            alerts.forEach(function (alert) {
                let bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                bsAlert.close();
            });
        }, 5000); // 5000ms = 5 giây
    });
</script>

@endsection
