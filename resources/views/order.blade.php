@extends('layouts.app')
@section('content')
<section id="app" class="space-y-6">
    <div class="card custom-card">
    <div class="card-body p-4">
        <div class="mb-3">
            <h6 class="card-title mb-0">Danh Sách Đơn Hàng</h6>
            <div class="my-3 border-top"></div>
        </div>
        <div class="table-responsive theme-scrollbar">
            <table class="display table table-bordered table-stripped text-nowrap" id="basic-1">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Mã Đơn</th>
                        <th>Link Map</th>
                        <th>Thao Tác</th>
                        <th>Trạng Thái</th>
                        <th>Ghi Chú</th>
                        <th>Nội Dung</th>
                        <th>Ảnh Review</th>
                        <th>Link Drive</th>
                        <th>Đơn Giá</th>
                        <th>Thời gian</th>
                        <th>Ngày Hoàn Thành</th>
                    </tr>
                </thead>
                <tbody>
                    @if($orders!=null)
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->code }}</td>
                                <td>
                                    {{ Str::limit($order->map_link, 40) }}
                                    <button class="btn btn-sm btn-outline-secondary ms-2 copy-btn" data-link="{{ $order->map_link }}">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </td>
                                <td>{{ $order->action }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->note }}</td>
                                <td>{{ $order->content }}</td>
                                <td>{{ $order->image }}</td>
                                <td>
                                    {{ Str::limit($order->drive_link, 40) }}
                                    <button class="btn btn-sm btn-outline-secondary ms-2 copy-btn" data-link="{{ $order->drive_link }}">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->time }}</td>
                                <td>{{ $order->completed_at }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    </div>
    </section>


    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nội dung</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="modalContent"></div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
        </div>
    </div>
    </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.copy-btn').forEach(function (btn) {
                btn.addEventListener('click', function () {
                    const link = btn.getAttribute('data-link');
                    navigator.clipboard.writeText(link).then(() => {
                        alert('Đã sao chép link!');
                    }).catch(err => {
                        alert('Không thể sao chép link');
                    });
                });
            });
        });
    </script>

@endsection
