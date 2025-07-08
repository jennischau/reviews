@extends('admin.layout.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Đơn review maps</h3>
                {{-- <a href="{{ route('admin.type.insert') }}" class="btn btn-primary">Thêm website</a> --}}
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Loại Website</li>
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
                            <th>MÃ ĐƠN</th>
                            <th>LINK MAPS</th>
                            <th>TRẠNG THÁI</th>
                            <th>GHI CHÚ</th>
                            <th>NỘI DUNG</th>
                            <th>XỬ LÝ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->code }}</td>
                                <td >
                                    {{ Str::limit($order->map_link, 40) }}
                                    <button class="btn btn-sm btn-outline-secondary ms-2 copy-btn" data-link="{{ $order->map_link }}">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </td>
                                <td>
                                    <form action="{{ route('admin.updateStatus',['id' => $order->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn {{ $order->status=='Đang chờ' ? "btn-success" : "btn-primary" }}">{{ $order->status }}</button>
                                    </form>
                                </td>
                                <td>{{ $order->note }}</td>
                                <td>{{ $order->content }}</td>
                                <td>
                                    {{-- <a href="{{ route('admin.type.update',['id' => $order->id]) }}" class="btn badge bg-success">Cập nhật</a> --}}
                                    <!-- Button trigger modal -->
                                    <button type="button" class="badge bg-danger" data-bs-toggle="modal" data-bs-target="#typeWebsite{{ $order->id }}">
                                        Xoá
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="typeWebsite{{ $order->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                            {{-- <form action="{{ route('admin.type.delete',['id' => $order->id]) }}" method="GET">
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
