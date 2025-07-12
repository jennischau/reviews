@extends('layouts.app')
@section('content')
<div class="card p-4">
    <div class="row justify-content-center">
      <div class="col-md-5 col-sm-6 mb-3">
        <div style="background: transparent">
          <div class="text-center">
            <img class="img-fluid" src="https://img.vietqr.io/image/{{ $payment->short_name }}-{{ $payment->account_number }}-compact.png?addInfo={{ Auth::user()->name }}%20{{ 1000+Auth::user()->id }}%20{{ $payment->recipient }}" width="150" alt="QR VCB">
            <h4 class="mt-3">{{ $payment->name_bank }}</h4>
          </div>
          <div class="text-center" style="font-size: 20px">
            <div>
              STK:
              <span id="account_number1" class="text-danger">{{ $payment->account_number }}</span>
              <button class="btn btn-sm btn-outline-primary ms-2 copy-btn" data-clipboard-text="{{ $payment->account_number }}">
                <i class="fas fa-copy"></i>
            </button>
            </div>
            <div>
              CTK: <span class="text-danger">{{ $payment->account_name }}</span>
            </div>
            <div>
              Nội dung:
              <span id="memo1" class="text-danger">{{ Auth::user()->name }} {{ 1000+Auth::user()->id }} {{ $payment->recipient }}</span>
              <button class="btn btn-sm btn-outline-primary ms-2 copy-btn" data-clipboard-text="{{ Auth::user()->name }} {{ 1000+Auth::user()->id }} {{ $payment->recipient }}">
                <i class="fas fa-copy"></i>
            </button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-12">
        <div class="text-center">
          <h3 class="text-danger fw-bold">LƯU Ý</h3>
          <h4>- Hãy chuyển khoản đúng nội dung để hệ thống tự cộng tiền sau 1-2 phút. Nếu gặp vấn đề vui lòng liên hệ admin.</h4>
        </div>
      </div>
    </div>
  </div>

  <!-- Warning -->
  <div class="alert alert-warning text-center mt-2">
    <h4 class="text-danger fw-bold">LƯU Ý</h4>
    <p>Hãy chuyển khoản đúng nội dung để hệ thống tự động cộng tiền sau 1-2 phút.<br>Nếu gặp vấn đề vui lòng liên hệ admin.</p>
  </div>

  <!-- Table History -->
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="mb-3">Lịch sử nạp tiền</h5>
                {{-- <form action="{{ route('vnpay.payment') }}" method="GET">
                    <input type="number" class="p-1" name="amount" placeholder="Nhập số tiền muốn nạp" required step="1000" min="1000">
                    <button type="submit" class="btn btn-primary">Thanh toán qua VNPAY</button>
                </form> --}}
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
                                    <td>{{ number_format($transaction->balance_before, 0, ',', '.') }} đ</td>
                                    <td>{{ number_format($transaction->amount, 0, ',', '.') }} đ</td>
                                    <td>{{ number_format($transaction->balance_after, 0, ',', '.') }} đ</td>
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
<script src="https://unpkg.com/clipboard@2/dist/clipboard.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const clipboard = new ClipboardJS('.copy-btn');

            clipboard.on('success', function (e) {
                e.clearSelection();
            });
        });
    </script>
@endsection
