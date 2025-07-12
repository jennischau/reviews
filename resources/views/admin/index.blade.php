@extends('admin.layout.app')
@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Đơn review maps</h3>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        {{-- <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li> --}}
                        <li class="breadcrumb-item active" aria-current="page">Review maps</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-body theme-scrollbar">
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
                                <td>
                                    <div style="min-width: 200px;">
                                        {{ $order->code }}
                                    </div>
                                </td>
                                <td >
                                    <div class="d-flex">
                                        <a href="{{ $order->map_link }}">{{ Str::limit($order->map_link, 35) }}</a>
                                    </div>
                                </td>
                                <td>
                                    <form action="{{ route('admin.updateStatus',['id' => $order->id]) }}" method="POST">
                                        @csrf
                                        @php
                                            $status = $order->status;
                                            $lockStatuses = ['Đang thực hiện', 'Đã báo cáo', 'Hoàn thành'];
                                        @endphp
                                        <select name="status" onchange="this.form.submit()" class="form-select form-select-sm" style="min-width: 150px">
                                            <option value="Đang chờ"
                                                {{ $status == 'Đang chờ' ? 'selected' : '' }}
                                                {{ in_array($status, $lockStatuses) ? 'disabled' : '' }}>
                                                Đang chờ
                                            </option>

                                            <option value="Đang phân phối"
                                                {{ $status == 'Đang phân phối' ? 'selected' : '' }}
                                                {{ in_array($status, $lockStatuses) ? 'disabled' : '' }}>
                                                Đang phân phối
                                            </option>

                                            <option value="Đang thực hiện"
                                                {{ $status == 'Đang thực hiện' ? 'selected' : '' }}>
                                                Đang thực hiện
                                            </option>

                                            <option value="Đã báo cáo"
                                                {{ $status == 'Đã báo cáo' ? 'selected' : '' }}>
                                                Đã báo cáo
                                            </option>

                                            <option value="Hoàn thành"
                                                {{ $status == 'Hoàn thành' ? 'selected' : '' }}>
                                                Hoàn thành
                                            </option>
                                        </select>
                                    </form>
                                </td>
                                <td>
                                    <div style="min-width: 120px;">
                                        {{ $order->note }}
                                    </div>
                                </td>
                                <td>
                                    <div style="min-width: 150px;">
                                        @if ($order->content !=null)
                                            {{ $order->content }}
                                        @else
                                            <div class="text-danger">Trống</div>
                                        @endif
                                    </div>
                                </td>
                                <td>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>

    </section>
</div>
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
