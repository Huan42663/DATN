@extends('admin.master')

@section('title', 'Thêm Sản Phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Sản phẩm </h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.products.list') }}">Danh sách </a></li>
                <li class="breadcrumb-item">Thêm mới </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-content">
        <div class="row">
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <form action="{{ route('Administration.products.store') }}" method="post" enctype="multipart/form-data"
                class="d-flex">
                @csrf
                <div class="col-lg-12">
                    <div class="card border-top-0">
                        <div class="tab-content">
                            <div class="card-body personal-info">
                                <div class="row">
                                    <div class="col-9">
                                        <div class="mb-4  align-items-center justify-content-between">
                                            <h5 class="fw-bold mb-0 me-4">
                                                <span class="d-block mb-2">Thêm Mới Sản Phẩm:</span>
                                            </h5>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="product_name" class="fw-semibold">Tên Sản Phẩm: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="product_name"
                                                            name="product_name" placeholder="Nhập tên sản phẩm "
                                                            value={{ old('product_name') }}><br>
                                                    </div>
                                                    @error('product_name')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="price" class="fw-semibold">Giá: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <input type="number" min="1" max="9999999999" class="form-control"
                                                            id="price" name="price" placeholder="Nhập giá "
                                                            value={{ old('price') }}>

                                                    </div>
                                                    @error('price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="sale_price" class="fw-semibold"> Giá Khuyến mãi: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <input type="number" min="0" max="9999999999"  class="form-control"
                                                            id="sale_price" name="sale_price" placeholder="Nhập giá khuyến mãi "
                                                            value={{ old('sale_price') }}>

                                                    </div>
                                                    @error('sale_price')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="quantity" class="fw-semibold">Số Lượng: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <input type="number" min="0" max="9999999999"class="form-control"
                                                            id="quantity" name="quantity" placeholder="Nhập số lượng "
                                                            value={{ old('quantity') }}>

                                                    </div>
                                                    @error('quantity')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="weight" class="fw-semibold">Cân Nặng: </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <input type="number" step="0.01"  class="form-control"
                                                            id="weight" name="weight" placeholder="Nhập cân nặng " min="0" max="9999999999"
                                                            value={{ old('weight') }}>

                                                    </div>
                                                    @error('weight')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="description" class="fw-semibold">Mô Tả</label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="">
                                                        <textarea id="editor" name="description" rows="10">{{ old('description') }}</textarea>
                                                    </div>
                                                    @error('description')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="product_image" class="fw-semibold"> Ảnh Sản Phẩm </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" multiple
                                                            id="product_image" name="product_image[]" multiple>
                                                    </div>
                                                    <span style="color: #282727">Hình ảnh đầu tiền sẽ là ảnh đại diện của
                                                        sản phẩm</span>
                                                    @error('product_image')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="status" class="fw-semibold"> Trạng thái  </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <select name="status" id="status" class="form-control">
                                                            <option value="1"
                                                                {{ old('status') == 1 ? 'selected' : '' }}>Hoạt động 
                                                            </option>
                                                            <option value="2"
                                                                {{ old('status') == 2 ? 'selected' : '' }}>Không hoạt động 
                                                            </option>
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="status" class="fw-semibold"> color </label>
                                                </div>

                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <select class="form-select form-control max-select"
                                                            data-select2-selector="tag" data-max-select2="tag" multiple
                                                            name="colors[]">
                                                            <option value="0"
                                                                {{ in_array(0, old('colors', [])) ? 'selected' : '' }}>ALL
                                                            </option>
                                                            @foreach ($colors as $key => $item)
                                                                <option value="{{ $item->color_id }}"
                                                                    {{ in_array($item->color_id, old('colors', [])) ? 'selected' : '' }}>
                                                                    {{ $item->color_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-4 align-items-center">
                                                <div class="col-lg-4">
                                                    <label for="status" class="fw-semibold"> Size </label>
                                                </div>
                                                <div class="col-lg-8">
                                                    <div class="input-group">
                                                        <select class="form-select form-control max-select"
                                                            data-select2-selector="tag" data-max-select2="tag" multiple
                                                            name="sizes[]">
                                                            <option value="0"
                                                                {{ in_array(0, old('sizes', [])) ? 'selected' : '' }}>ALL
                                                            </option>
                                                            @foreach ($sizes as $key => $item)
                                                                <option value="{{ $item->size_id }}"
                                                                    {{ in_array($item->size_id, old('sizes', [])) ? 'selected' : '' }}>
                                                                    {{ $item->size_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <h5 class="fw-bold mb-0 me-4">
                                            <span class="d-block mb-2">Danh Mục Sản Phẩm:</span>
                                        </h5>
                                        @foreach ($categories as $item)
                                            <div class="form-check">
                                                <input type="checkbox" name="category_id[]"
                                                    value="{{ $item->category_id }}"
                                                    @if (old('category_id')) @foreach (old('category_id') as $cate)
                                                @if ($cate == $item->category_id)
                                                    checked @endif
                                                    @endforeach
                                        @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $item->category_name }}
                                        </label>
                                    </div>
                                    @foreach ($cate_children as $item1)
                                        @if ($item1->category_parent_id == $item->category_id)
                                            <div class="form-check" style="margin-left: 15px">
                                                <input type="checkbox" name="category_id[]"
                                                    value="{{ $item1->category_id }}"
                                                    @if (old('category_id')) @foreach (old('category_id') as $cate)
                                                            @if ($cate == $item1->category_id)
                                                            checked @endif
                                                    @endforeach
                                        @endif>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $item1->category_name }}
                                        </label>
                                </div>
                                @endif
                                @endforeach
                                @endforeach

                                @error('category_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex">
                            <button type="submit" class="btn btn-lg btn-light-brand me-3">Thêm Mới</button>
                            <a href="{{ route('Administration.products.list') }}"><button type="button"
                                    class="btn btn-lg btn-success">Danh sách</button></a>
                        </div>
                    </div>
                </div>
        </div>
    </div>

    </form>
    </div>
    </div>
@endsection
