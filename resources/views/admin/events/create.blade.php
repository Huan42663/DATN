@extends('admin.master')

@section('title', 'thêm sự kiện')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Events</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">create</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-content">

        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top-0">
                    <div class="tab-content">
                        <div class="card-body personal-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0 me-4">
                                    <span class="d-block mb-2">Thêm sự kiện:</span>
                                </h5>
                            </div>
                            <form action="{{ route('Administration.events.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="event_name" class="fw-semibold">Tên sự kiện: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" name="event_name" value="{{ old('event_name') }}"
                                                class="form-control" id="event_name" placeholder="Event Name">
                                        </div>
                                        @error('event_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="date_start" class="fw-semibold">Thời gian bắt đầu: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="datetime-local" value="{{ old('date_start') }}" name="date_start"
                                                class="form-control">
                                        </div>
                                        @error('date_start')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="date_end" class="fw-semibold">Thời gian kết thúc: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" value="{{ old('date_end') }}"
                                                name="date_end" id="">
                                        </div>
                                        @error('date_end')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="type_event" class="fw-semibold">Kiểu sự kiện: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select name="type_event" class="form-control" id="type_event">
                                                <option value="0">Giới thiệu</option>
                                                <option value="1">Giảm giá</option>
                                            </select>
                                        </div>
                                        @error('type_event')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center" id="discount" style="display:none">
                                    <div class="col-lg-4">
                                        <label for="type_event" class="fw-semibold">Giảm giá: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" name="discount" class="form-control">
                                        </div>
                                        @error('discount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Chọn sản phẩm: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <table id="example" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Tên sản phẩm</th>
                                                    <th>Ảnh sản phẩm</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $product)
                                                    <tr>
                                                        <td><input type="checkbox" name="products[]"
                                                                @if (old('products')) @foreach (old('products') as $item)
                                                                @checked($item == $product->product_id) @endforeach @endif
                                                                value="{{ $product->product_id }}" id=""></td>
                                                        <td>{{ $product->product_name }}</td>
                                                        <td><img src="{{ asset('storage/' . $product->product_image) }}"
                                                                alt=""></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-light-brand">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        a = document.querySelector('[id = "discount"]');
        selectElement = document.getElementById('type_event');
        selectElement.addEventListener('change', () => {
            const b = selectElement.value;
            if (b == 1) {
                a.style.display = 'flex';
            } else if (b == 0) {
                a.style.display = 'none';
            }
        });
    </script>
@endsection
