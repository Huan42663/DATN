@extends('admin.master')

@section('title', 'Thêm Biến Thể Sản Phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Sản phẩm </h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.products.list') }}">Danh sách </a></li>
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Chi tiết </a></li>


                <li class="breadcrumb-item">Thêm biến thể </li>
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
                                    <span class="d-block mb-2">Thêm biến thể:</span>
                                </h5>
                            </div>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <form action="{{ route('Administration.products.create-variant-update1') }}" method="post">
                                @csrf
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="status" class="fw-semibold">Màu </label>
                                    </div>

                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select class="form-select form-control max-select" data-select2-selector="tag"
                                                data-max-select2="tag" multiple name="colors[]">
                                                <option value="0"
                                                    {{ in_array(0, old('colors', [])) ? 'selected' : '' }}>ALL</option>
                                                @foreach ($colors as $key => $item)
                                                    <option value="{{ $item->color_id }}"
                                                        {{ in_array($item->color_id, old('colors', [])) ? 'selected' : '' }}>
                                                        {{ $item->color_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('colors')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="status" class="fw-semibold"> Size </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select class="form-select form-control max-select" data-select2-selector="tag"
                                                data-max-select2="tag" multiple name="sizes[]">
                                                <option value="0"
                                                    {{ in_array(0, old('sizes', [])) ? 'selected' : '' }}>ALL</option>
                                                @foreach ($sizes as $key => $item)
                                                    <option value="{{ $item->size_id }}"
                                                        {{ in_array($item->size_id, old('sizes', [])) ? 'selected' : '' }}>
                                                        {{ $item->size_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('sizes')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="price" class="fw-semibold">Giá: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="price" name="price" min="1" max="9999999999"
                                                placeholder="Nhập giá " value={{ old('price') }}  disabled>

                                        </div>
                                        @error('price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="sale_price" class="fw-semibold"> Giá khuyến mãi: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" min="0" max="9999999999" class="form-control" id="sale_price" name="sale_price"
                                                placeholder="Nhập giá khuyến mãi " value={{ old('sale_price') }} disabled>

                                        </div>
                                        @error('sale_price')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="quantity" class="fw-semibold">Số lượng: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" min="1"class="form-control" id="quantity" name="quantity"
                                                placeholder="Nhập số lượng " value={{ old('quantity') }} disabled>

                                        </div>
                                        @error('quantity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="weight" class="fw-semibold">Cân nặng: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" step="0.01" class="form-control" id="weight" name="weight"
                                                placeholder="Nhập cân nặng " value={{ old('weight') }}>

                                        </div>
                                        @error('weight')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="action" value="update">
                                <div class="row">
                                    <button type="submit" class="btn btn-lg btn-light-brand">Thêm mới </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
