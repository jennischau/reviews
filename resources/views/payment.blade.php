@extends('layouts.app')
@section('content')
<div class="card p-4 mb-4">
    <div class="row justify-content-center">
      <div class="col-md-6 text-center">
        <img src="https://api.vietqr.io/mbbank/0968533675/0/Danhgiamaps%20917/vietqr_net_2.jpg?accountName=Ngô%20Văn%20Nam" width="150" class="img-fluid">
        <h4 class="mt-3">mbbank</h4>
        <p class="mb-1">STK: <strong class="text-danger">0968533675</strong></p>
        <p class="mb-1">CTK: <strong class="text-danger">Ngô Văn Nam</strong></p>
        <p>Nội dung: <strong class="text-danger">Danhgiamaps 917</strong></p>
      </div>
    </div>
  </div>

  <!-- Warning -->
  <div class="alert alert-warning text-center">
    <h4 class="text-danger fw-bold">LƯU Ý</h4>
    <p>Hãy chuyển khoản đúng nội dung để hệ thống tự động cộng tiền sau 1-2 phút.<br>Nếu gặp vấn đề vui lòng liên hệ admin.</p>
  </div>

  <!-- Table History -->
  <div class="card">
    <div class="card-body">
      <h5 class="mb-3">Lịch sử nạp tiền</h5>
      <div class="table-responsive">
        <table class="table table-bordered" id="history-table">
          <thead class="table-light">
            <tr>
              <th>#</th>
              <th>Mã giao dịch</th>
              <th>Số dư trước</th>
              <th>Số tiền nạp</th>
              <th>Số dư sau</th>
              <th>Thời gian</th>
              <th>Trạng thái</th>
            </tr>
          </thead>
          <tbody>
            <!-- DataTable load here -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
