@extends('layouts.app')
@section('content')
<section id="app" class="space-y-6">
    <div class="card custom-card">
        <div class="card-body p-4">
            <div class="mb-3">
                <h6 class="card-title mb-0">Danh Sách Đơn Hàng Nhận</h6>
                <div class="my-3 border-top"></div>
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
            <div class="table-responsive theme-scrollbar">
                <table class="display table table-bordered table-stripped text-nowrap" id="basic-1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã Đơn</th>
                            <th>Nội dung</th>
                            <th>Số lượng</th>
                            <th>Thời gian</th>
                            <th>Nhận đơn</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($orders!=null)
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->code }}</td>
                                    <td>{{ $order->content }}</td>
                                    <td>{{ $order->price/15000 }}</td>
                                    <td>{{ $order->time }}</td>
                                    <td>
                                        <button type="button" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#typeWebsite{{ $order->id }}">
                                            NHẬN
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="typeWebsite{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Nhận đơn hàng review</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có muốn nhận đơn review này không?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                <form action="{{ route('receiveOrder',['id' => $order->id]) }}" method="GET">
                                                    @csrf
                                                        <button type="submit" class="btn btn-success">Nhận</button>
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mb-3 mt-3">
                <h6 class="card-title mb-0">Đơn Hàng Đã Nhận</h6>
                <div class="my-3 border-top"></div>
            </div>
            <div class="table-responsive theme-scrollbar">
                <table class="display table table-bordered table-stripped text-nowrap" id="basic-1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã Đơn</th>
                            <th>Link Map</th>
                            <th>Nội dung</th>
                            <th>Link Drive</th>
                            <th>Số lượng</th>
                            <th>Thời gian</th>
                            <th>Báo cáo</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($tasks!=null)
                            @foreach ($tasks as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->code }}</td>
                                    <td>
                                        <a href="{{ $order->map_link }}">{{ Str::limit($order->map_link, 40) }}</a>
                                    </td>
                                    <td>{{ $order->content }}</td>
                                    <td>
                                        <a href="{{ $order->drive_link }}">{{ Str::limit($order->drive_link, 40) }}</a>
                                    </td>
                                    <td>{{ $order->price/15000 }}</td>
                                    <td>{{ $order->time }}</td>
                                    <td>
                                        <button type="button" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#typeWebsite{{ $order->id }}">
                                            Báo cáo
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="typeWebsite{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Báo cáo đơn hàng review</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Bạn có xác nhận hoàn thành đơn này không?
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                <form action="{{ route('reportOrder', ['id'=> $order->id]) }}" method="GET">
                                                    @csrf
                                                        <button type="submit" class="btn btn-success">Xác Nhận</button>
                                                </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="mb-3 mt-3">
                <h6 class="card-title mb-0">Đơn Hàng Đã Nhận</h6>
                <div class="my-3 border-top"></div>
            </div>
            <div class="table-responsive theme-scrollbar">
                <table class="display table table-bordered table-stripped text-nowrap" id="basic-1">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Mã Đơn</th>
                            <th>Link Map</th>
                            <th>Ghi Chú</th>
                            <th>Nội Dung</th>
                            <th>Ảnh Review</th>
                            <th>Link Drive</th>
                            <th>Số lượng</th>
                            <th>Thời gian</th>
                            <th>Thời gian hoàn thành</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($completes!=null)
                            @foreach ($completes as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->code }}</td>
                                    <td>
                                        <a href="{{ $order->map_link }}">{{ Str::limit($order->map_link, 40) }}</a>
                                    </td>
                                    <td>{{ $order->note }}</td>
                                    <td>{{ $order->content }}</td>
                                    <td>{{ $order->image }}</td>
                                    <td>
                                        <a href="{{ $order->drive_link }}">{{ Str::limit($order->drive_link, 40) }}</a>
                                    </td>
                                    <td>{{ $order->price/15000 }}</td>
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
@endsection
