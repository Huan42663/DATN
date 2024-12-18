@extends('admin.master')

@section('title', 'Cập Nhật Sản Phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Sản Phẩm</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.products.list') }}">Danh Sách</a></li>
                <li class="breadcrumb-item"> <a
                        href="{{ Route('Administration.products.show', $product->product_slug) }}">Chi Tiết</a></li>
                <li class="breadcrumb-item">Cập Nhật</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top-0 shadow-sm">
                    <div class="tab-content">
                        <div class="card-body">
                            <h5 class="fw-bold mb-4">Cập nhật sản phẩm</h5>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <form action="{{ route('Administration.products.update', $product->product_slug) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <!-- Thông tin chung của sản phẩm -->
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_name" class="fw-semibold">Tên sản phẩm:</label>
                                            <input type="text" class="form-control" id="product_name" name="product_name"
                                                value="{{ $product->product_name }}" placeholder="Tên sản phẩm">
                                            @error('product_name')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="status" class="fw-semibold">Trạng thái:</label>
                                            <select name="status" id="status" class="form-control">
                                                <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Hoạt
                                                    động</option>
                                                <option value="2" {{ $product->status == 2 ? 'selected' : '' }}>Ngừng
                                                    hoạt động</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description" class="fw-semibold">Mô tả:</label>
                                            <textarea id="editor" name="description" rows="5" class="form-control">{{ $product->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_image" class="fw-semibold">Hình ảnh sản phẩm:</label>
                                            @if ($product->product_image)
                                                <img width="100px" src="{{ asset('storage/' . $product->product_image) }}"
                                                    alt="Hình ảnh sản phẩm" class="img-thumbnail mb-2"
                                                    style="max-width: 100%; height: auto;">
                                            @endif
                                            <input type="file" class="form-control" id="product_image"
                                                name="product_image">
                                        </div>
                                    </div>
                                </div>

                                <hr class="my-4">

                                {{-- <h5 class="fw-bold mb-3">Biến thể sản phẩm</h5>

                                <!-- Hiển thị từng biến thể -->
                                <div class="row">
                                    @foreach ($productVariants as $index => $variant)
                                        <div class="col-md-4 mb-4">
                                            <div class="card p-3 border">
                                                <h6 class="fw-semibold">Biến thể {{ $index + 1 }}</h6>

                                                <div class="form-group mb-3">
                                                    <label for="size_{{ $index }}" class="fw-semibold">Kích
                                                        cỡ:</label>
                                                    <select name="variants[{{ $index }}][size_id]"
                                                        id="size_{{ $index }}" class="form-control">
                                                        <option value="0"
                                                            {{ $variant->size_id == 0 ? 'selected' : '' }}>Tất cả</option>
                                                        @foreach ($sizes as $size)
                                                            <option value="{{ $size->size_id }}"
                                                                {{ $variant->size_id == $size->size_id ? 'selected' : '' }}>
                                                                {{ $size->size_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="color_{{ $index }}" class="fw-semibold">Màu
                                                        sắc:</label>
                                                    <select name="variants[{{ $index }}][color_id]"
                                                        id="color_{{ $index }}" class="form-control">
                                                        <option value="0"
                                                            {{ $variant->color_id == 0 ? 'selected' : '' }}>Tất cả</option>
                                                        @foreach ($colors as $color)
                                                            <option value="{{ $color->color_id }}"
                                                                {{ $variant->color_id == $color->color_id ? 'selected' : '' }}>
                                                                {{ $color->color_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="price_{{ $index }}" class="fw-semibold">Giá:</label>
                                                    <input type="text" class="form-control"
                                                        id="price_{{ $index }}"
                                                        name="variants[{{ $index }}][price]"
                                                        value="{{ $variant->price }}" placeholder="Giá">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="sale_price_{{ $index }}" class="fw-semibold">Giá
                                                        giảm:</label>
                                                    <input type="text" class="form-control"
                                                        id="sale_price_{{ $index }}"
                                                        name="variants[{{ $index }}][sale_price]"
                                                        value="{{ $variant->sale_price }}" placeholder="Giá giảm">
                                                </div>

                                                <div class="form-group mb-3">
                                                    <label for="quantity_{{ $index }}" class="fw-semibold">Số
                                                        lượng:</label>
                                                    <input type="text" class="form-control"
                                                        id="quantity_{{ $index }}"
                                                        name="variants[{{ $index }}][quantity]"
                                                        value="{{ $variant->quantity }}" placeholder="Số lượng">
                                                </div>

                                                <div class="form-group">
                                                    <label for="weight_{{ $index }}" class="fw-semibold">Trọng
                                                        lượng:</label>
                                                    <input type="text" class="form-control"
                                                        id="weight_{{ $index }}"
                                                        name="variants[{{ $index }}][weight]"
                                                        value="{{ $variant->weight }}" placeholder="Trọng lượng">
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div> --}}
                                <div class="row mb-3">
                                    <h5 class="fw-bold mb-0 me-4">
                                        <span class="d-block mb-2">Danh Mục Sản Phẩm:</span>
                                    </h5>
                                    @foreach ($categories as $item)
                                        <div class="form-check">
                                            <input type="checkbox" name="category_id[]"  value="{{ $item->category_id }}"  
                                            @foreach ($data6 as $item1 )
                                                @checked($item->category_id == $item1->category_id)
                                            @endforeach>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ $item->category_name }}
                                            </label>
                                        </div>
                                        @foreach ($cate_children as $item1)
                                            @if ($item1->category_parent_id == $item->category_id)
                                                <div class="form-check" style="margin-left: 15px">
                                                    <input type="checkbox" name="category_id[]"  value="{{ $item1->category_id }}"  
                                                    @foreach ($data6 as $item2 )
                                                        @checked($item1->category_id == $item2->category_id)
                                                    @endforeach>
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        {{ $item1->category_name }}
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endforeach

                                </div>

                                <div class="row">
                                    <button type="submit" class="btn btn-lg btn-primary">Cập nhật sản phẩm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
