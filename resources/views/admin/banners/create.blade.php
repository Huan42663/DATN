@extends('admin.master')

@section('title', 'thêm Banner')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Banner</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('Administration.Home') }}">Trang chủ </a></li>
                <li class="breadcrumb-item">Thêm mới</li>
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
                                    <span class="d-block mb-2">Thêm banner:</span>
                                </h5>
                            </div>
                            <form action="{{ route('Administration.banners.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="image_name" class="fw-semibold">Image_name: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="file" name="image_name" value="{{ old('image_name') }}"
                                                class="form-control" id="image_name" placeholder="image_name">
                                        </div>
                                        @error('image_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="image_name" class="fw-semibold">Event_id: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select name="event_id" class="form-control" id="">
                                            <option disabled hidden selected>Sự Kiện</option>
                                            @foreach ($events as $event)
                                                <option value="{{ $event->event_id }}">{{ $event->event_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('event_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="image_name" class="fw-semibold">Prodcut_id: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="product_id" id="">
                                            <option disabled hidden selected>Sản phẩm</option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->product_id }}">{{ $product->product_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
