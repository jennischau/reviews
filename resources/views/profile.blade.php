@extends('layouts.app')
@section('content')
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
<div class="row">
    <div class="col-12 col-md-6 mb-3">
        <div class="card">
            <div class="card-body p-4">
                <div class="mb-3">
                    <h6 class="card-title mb-0">Thông tin tài khoản</h6>
                    <div class="my-3 border-top"></div>
                </div>
                <form action="#!">
                    <div class="mb-1 row">
                        <div class="col-md-6">
                        <label for="username" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ Auth::user()->name }}" disabled>
                        </div>
                        <div class="col-md-6">
                        <label for="email" class="form-label">Địa chỉ e-mail</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ Auth::user()->email }}" disabled>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <div class="col-md-6">
                            <label for="created_at" class="form-label">Cấp bậc</label>
                            <input type="text" class="form-control" id="created_at" name="created_at" value="{{ Auth::user()->level }}" disabled>
                        </div>

                        <div class="col-md-6">
                            <label for="updated_at" class="form-label">Cập nhật</label>
                            <input type="text" class="form-control" id="updated_at" name="updated_at" value="{{ Auth::user()->updated_at }}" disabled>
                        </div>
                    </div>
                    <div class="mb-1 row">
                        <div class="col-md-6">
                            <label for="balance" class="form-label">Số dư</label>
                            <input type="text" class="form-control" id="balance" name="balance" value="{{ number_format(Auth::user()->balance, 0) }} ₫" disabled>
                        </div>
                        <div class="col-md-6">
                            <label for="total_deposit" class="form-label">Tổng nạp</label>
                            <input type="text" class="form-control" id="total_deposit" name="total_deposit" value="{{ number_format(Auth::user()->total_deposit, 0) }} ₫" disabled>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 mb-3">
        <div class="card">
            <div class="card-body p-4">
                <div class="mb-3">
                    <h6 class="card-title mb-0">Thay Đổi Mật Khẩu</h6>
                    <div class="my-3 border-top"></div>
                </div>
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Mật khẩu cũ</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required value="{{ old('old_password') }}">
                        @error('old_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Mật khẩu mới</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required value="{{ old('new_password') }}">
                        @error('new_password')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="retype_new_password" class="form-label">Nhập lại mật khẩu mới</label>
                        <input type="password" class="form-control" id="retype_new_password" name="new_password_confirmation" required value="{{ old('new_password_confirmation') }}">
                    </div>
                    <div class="text-end">
                        <button class="btn btn-primary">Cập nhật ngay</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-md-12  mb-3">
        <div class="card">
            <div class="card-body p-4">
                <div class="mb-3">
                    <h6 class="card-title mb-0">Lịch Sử Giao Dịch</h6>
                    <div class="my-3 border-top"></div>
                </div>
                <div class="table-responsive theme-scrollbar">
                    <table class="display table table-bordered table-stripped text-nowrap" id="basic-1">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tài khoản</th>
                                <th>Mã giao dịch</th>
                                <th>Số dư trước</th>
                                <th>Giao dịch</th>
                                <th>Số dư sau</th>
                                <th>Nội dung</th>
                                <th>Thời gian</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($transactions!=null)
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td>{{ $transaction->id }}</td>
                                        <td>{{ $transaction->user->name }}</td>
                                        <td>{{ $transaction->transaction_code }}</td>
                                        <td>{{ $transaction->balance_before }}</td>
                                        <td>{{ $transaction->amount }}</td>
                                        <td>{{ $transaction->balance_after }}</td>
                                        <td>{{ $transaction->description }}</td>
                                        <td>{{ $transaction->created_at }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body p-4">
                <div class="mb-3">
                <h6 class="card-title mb-0">Lịch Sử Hoạt Động</h6>
                <div class="my-3 border-top"></div>
                </div>
                <div class="table-responsive theme-scrollbar">
                    <table class="display table table-bordered table-stripped text-nowrap datatable" id="datatable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Nội dung</th>
                            <th>Địa chỉ IP</th>
                            <th>Thời gian</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($activities!=null)
                                @foreach ($activities as $activity)
                                    <tr>
                                        <td>{{ $activity->id }}</td>
                                        <td>{{ $activity->user->name }}</td>
                                        <td>{{ $activity->action }}</td>
                                        <td>{{ $activity->ip_address }}</td>
                                        <td>{{ $activity->created_at }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
