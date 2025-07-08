@extends('layouts.app')
@section('content')
  <!-- Warning -->
  <div class="alert alert-warning text-center">
    <h4 class="text-danger fw-bold">LƯU Ý</h4>
    <p>Hãy chuyển khoản đúng nội dung để hệ thống tự động cộng tiền sau 1-2 phút.<br>Nếu gặp vấn đề vui lòng liên hệ admin.</p>
  </div>

  <!-- Table History -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="mb-3">Lịch sử nạp tiền</h5>
                <form action="{{ route('vnpay.payment') }}" method="GET">
                    <input type="number" class="p-1" name="amount" placeholder="Nhập số tiền muốn nạp" required step="1000" min="1000">
                    <button type="submit" class="btn btn-primary">Thanh toán qua VNPAY</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" id="history-table">
                    <thead class="table-light">
                        <tr>
                        <th>#</th>
                        <th>Mã giao dịch</th>
                        <th>Số dư trước</th>
                        <th>Số tiền nạp</th>
                        <th>Số dư sau</th>
                        <th>Nội dung</th>
                        <th>Thời gian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($transactions!=null)
                            @foreach ($transactions as $transaction)
                            @if($transaction->balance_after > $transaction->balance_before )
                                <tr>
                                    <td>{{ $transaction->id }}</td>
                                    <td>{{ $transaction->transaction_code }}</td>
                                    <td>{{ $transaction->balance_before }}</td>
                                    <td>{{ $transaction->amount }}</td>
                                    <td>{{ $transaction->balance_after }}</td>
                                    <td>{{ $transaction->description }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                </tr>
                            @endif
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
