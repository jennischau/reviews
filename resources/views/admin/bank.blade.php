@extends('admin.layout.app')
@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Thông tin ngân hàng</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Sửa Thông tin ngân hàng</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <form action="{{ route('admin.updateBank') }}" method="post"  enctype="multipart/form-data">
                <table class="table table-bordered">
                    <tr>
                        <td><label class="form-label">Tên ngân hàng</label></td>
                        <td>
                            <input type="text" class="form-control" id="name_bank" placeholder="Vietcombank" name="name_bank"
                                value="{{ old('name_bank') ?? $user->name_bank}}" />
                            @error('name_bank')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label class="form-label">Tên viết tắt</label></td>
                        <td>
                            <input type="text" class="form-control" id="short_name" placeholder="VCB" name="short_name"
                                value="{{ old('short_name') ?? $user->short_name}}" />
                            @error('short_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label class="form-label">Số tài khoản</label></td>
                        <td>
                            <input type="text" class="form-control" id="account_number" placeholder="0123456789" name="account_number"
                                value="{{ old('account_number') ?? $user->account_number}}" />
                            @error('account_number')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label class="form-label">Tên người nhận</label></td>
                        <td>
                            <input type="text" class="form-control" id="account_name" placeholder="Nguyễn Văn Hoàng Tâm" name="account_name"
                                value="{{ old('account_name') ?? $user->account_name}}" />
                            @error('account_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                    <tr>
                        <td><label class="form-label">Tên viết tắt nhận</label></td>
                        <td>
                            <input type="text" class="form-control" id="recipient" placeholder="tam" name="recipient"
                                value="{{ old('recipient') ?? $user->recipient}}" />
                            @error('recipient')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </td>
                    </tr>
                </table>
                @csrf
                <button type="submit" class="btn btn-primary">Thêm</button>
                <a href="{{ route('admin.index') }}" class="btn btn-danger">Huỷ</a>
            </form>
        </section>
    </div>
@endsection
