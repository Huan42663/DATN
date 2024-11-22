@extends('admin.master')

@section('title', 'thêm sản phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Products</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.products.list') }}">List</a></li>
                <li class="breadcrumb-item">Create</li>
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
                                    <span class="d-block mb-2">Create A Product:</span>
                                </h5>
                            </div>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <form action="{{ route('Administration.products.store') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="product_name" class="fw-semibold">Product Name: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="product_name" name="product_name"
                                                placeholder="Product Name"><br>
                                            @error('product_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="price" class="fw-semibold">Price: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control" id="price" name="price"
                                                placeholder="price">
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="sale_price" class="fw-semibold"> Sale Price: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" min="0" class="form-control" id="sale_price" name="sale_price"
                                                placeholder="price sale">
                                            @error('sale_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="quantity" class="fw-semibold">Quantity: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control" id="quantity" name="quantity"
                                                placeholder="Quantity">
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="weight" class="fw-semibold">Weight: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" min="1" class="form-control" id="weight" name="weight"
                                                placeholder="Weight">
                                            @error('weight')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="description" class="fw-semibold"> Description</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <textarea id="editor" name="description" rows="10"></textarea>
                                        </div>
                                        @error('description')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="product_image" class="fw-semibold"> Product Images </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="file" class="form-control" multiple id="product_image"
                                                name="product_image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="status" class="fw-semibold"> Status </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1" checked>Active</option>
                                                <option value="2">Inactive</option>
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
                                                <option value="0">ALL</option>
                                                @foreach ($colors as $key => $item)
                                                    <option value="{{ $item->color_id }}">{{ $item->color_name }}</option>
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
                                                <option value="0">ALL</option>
                                                @foreach ($sizes as $key => $item)
                                                    <option value="{{ $item->size_id }}">{{ $item->size_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-lg btn-light-brand">Add New</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
