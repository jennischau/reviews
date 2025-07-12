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
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Thành công!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Lỗi!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    @endif
    <section class="section">
        <div class="card">
            <div class="card-body">
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TÊN</th>
                            <th>EMAIL</th>
                            <th >CẤP BẬC</th>
                            <th>SỐ DƯ</th>
                            <th>TỔNG NẠP</th>
                            <th>XỬ LÝ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <div style="min-width: 200px;">{{ $user->name }}</div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <span title="{{ $user->email }}">
                                            {{ Str::limit($user->email, 20) }}
                                        </span>
                                        <button class="btn btn-sm btn-outline-secondary ms-2 copy-btn" data-clipboard-text="{{ $user->email }}">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </td>
                                <td >
                                    <form action="{{ route('admin.user.updateLevel', ['id' => $user->id]) }}" method="POST">
                                        @csrf
                                        <select name="level" onchange="this.form.submit()" class="form-select form-select-sm" style="min-width: 100px">
                                            <option value="user" {{ $user->level == 'user' ? 'selected' : '' }}>User</option>
                                            <option value="reviewer" {{ $user->level == 'reviewer' ? 'selected' : '' }}>Reviewer</option>
                                            <option value="admin" {{ $user->level == 'admin' ? 'selected' : '' }}>Admin</option>
                                        </select>
                                    </form>

                                </td>
                                <td>
                                    <div style="min-width: 120px;">
                                        {{  number_format($user->balance, 0, ',', '.') }} đ
                                    </div>
                                </td>
                                <td>
                                    <div style="min-width: 120px;">
                                        {{  number_format($user->total_deposit, 0, ',', '.') }} đ
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#typeWebsite{{ $user->id }}">
                                        Nạp tiền
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="typeWebsite{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Báo cáo đơn hàng review</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('admin.payment') }}" method="POST">
                                                <div class="modal-body">
                                                    Vui lòng nhập số tiền
                                                    <input type="number" class="p-1" name="amount" placeholder="10.000đ" required step="1000" min="1000">
                                                </div>
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">Xác Nhận</button>
                                                </div>
                                            </form>
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
<script src="https://unpkg.com/clipboard@2/dist/clipboard.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const clipboard = new ClipboardJS('.copy-btn');

        clipboard.on('success', function (e) {
            alert('Đã sao chép liên kết!');
            e.clearSelection();
        });

        clipboard.on('error', function (e) {
            alert('Không thể sao chép. Vui lòng sao chép thủ công.');
        });
    });
</script>
@endsection
