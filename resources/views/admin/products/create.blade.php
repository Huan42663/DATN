@extends('admin.master')

@section('title', 'thêm sản phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Products</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('home') }}">Home</a></li>
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
                                    <span class="d-block mb-2">Create A Product:</span>
                                </h5>
                            </div>
                            <form action="" enctype="multipart/form-data">
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="product_name" class="fw-semibold">Product Name: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="product_name"
                                                placeholder="Product Name">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="price" class="fw-semibold">Price: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="price" placeholder="price">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="sale_price" class="fw-semibold"> Sale Price: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="sale_price"
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
                                            <input type="text" class="form-control" id="quantity"
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
                                            <input type="text" class="form-control" id="weight" placeholder="Weight">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="description" class="fw-semibold"> Description</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <textarea id="editor" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="product_image" class="fw-semibold"> Product Images </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="file" class="form-control" multiple id="product_image">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="status" class="fw-semibold"> Status </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select name="" id="status" class="form-control">
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
                                                data-select2-selector="tag" data-max-select2="tag" multiple>
                                                <option value="">VIP</option>
                                                <option value="">Bugs</option>
                                                <option value="">Team</option>
                                                <option value="">Primary</option>
                                                <option value="">Updates</option>
                                                <option value="">Personal</option>
                                                <option value="">Promotions</option>
                                                <option value="">Customs</option>
                                                <option value="">Wholesale</option>
                                                <option value="">Low Budget</option>
                                                <option value="">High Budget</option>
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
                                                data-select2-selector="tag" data-max-select2="tag" multiple>
                                                <option value="">VIP</option>
                                                <option value="">Bugs</option>
                                                <option value="">Team</option>
                                                <option value="">Primary</option>
                                                <option value="">Updates</option>
                                                <option value="">Personal</option>
                                                <option value="">Promotions</option>
                                                <option value="">Customs</option>
                                                <option value="">Wholesale</option>
                                                <option value="">Low Budget</option>
                                                <option value="">High Budget</option>
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
