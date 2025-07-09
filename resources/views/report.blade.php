@extends('layouts.app')
@section('content')
<div class="page-heading">
    <div class="mb-3 mt-3">
        <h6 class="card-title mb-0">Báo cáo đơn hàng</h6>
        <div class="my-3 border-top"></div>
    </div>
    <section class="section">
        <form action="{{ route('postReport') }}" method="post" enctype="multipart/form-data">

            <table class="table table-bordered">
                <tr>
                    <td><label class="form-label">Loại website</label></td>
                    <td>
                        <input type="text" class="form-control" id="type_name" placeholder="Tên Loại" name="name"
                            value="{{ old('name') }}" />
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
                <tr>
                    <td><label class="form-label">Route</label></td>
                    <td>
                        <input type="text" class="form-control" id="route" placeholder="Tên Loại" name="route"
                            value="{{ old('route') }}" />
                        @error('route')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </td>
                </tr>
            </table>
            @csrf
            <button type="submit" class="btn btn-primary">Báo cáo</button>
            <a href="{{ route('getTask') }}" class="btn btn-danger">Huỷ</a>
        </form>

    </section>
</div>
@endsection
