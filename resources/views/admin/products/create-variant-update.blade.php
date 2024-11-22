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
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Show</a></li>
                

                <li class="breadcrumb-item">create-Variant</li>
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
                                    <span class="d-block mb-2">Create Variant:</span>
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
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="price" class="fw-semibold">Price: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="price" name="price"
                                                placeholder="price">
                                            @error('product_name')
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
                                            <input type="text" class="form-control" id="sale_price" name="sale_price"
                                                placeholder="price sale">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="quantity" class="fw-semibold">Quantity: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="quantity" name="quantity"
                                                placeholder="Quantity">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="weight" class="fw-semibold">Weight: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="weight" name="weight"
                                                placeholder="Weight">
                                        </div>
                                    </div>
                                </div>
                                {{-- <input type="hidden" name="action" value="update"> --}}
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
