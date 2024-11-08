@extends('admin.master')

@section('title', 'chi tiết sản phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Products</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('home') }}">Home</a></li>
                <li class="breadcrumb-item">show</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-xxl-4 col-xl-6">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        <div class="mb-4 text-center">
                            <div class="wd-150 ht-150 mx-auto mb-3 position-relative">
                                <div class=" wd-150 ht-150 border border-5 border-gray-3">
                                    <img src="/admin/assets/images/avatar/1.png" alt="" class="img-fluid">
                                </div>
                                <div class="wd-10 ht-10 text-success rounded-circle position-absolute translate-middle"
                                    style="top: 76%; right: 10px">
                                </div>
                            </div>
                            <div class="mb-4">
                                <input placeholder="product name" style="border:none"
                                    class="text-center form-control fs-21 fw-bold d-block" value="alexander khoan">
                            </div>
                            <div class="fs-12 fw-normal text-muted text-center d-flex flex-wrap gap-3 mb-4">
                                <div
                                    class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                    <h6 class="fs-15 fw-bolder">Description:</h6>
                                    <p>Text</p>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 text-center pt-4">
                            <a href="javascript:void(0);" class="w-50 btn btn-light-brand">
                                <i class="feather-trash-2 me-2"></i>
                                <span>Delete</span>
                            </a>
                            <a href="javascript:void(0);" class="w-50 btn btn-primary">
                                <i class="feather-edit me-2"></i>
                                <span>Edit Product</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8 col-xl-6">
                <div class="card border-top-0">
                    <div class="tab-content">

                        <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                            <div class="about-section mb-5">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0">List of variant:</h5>
                                </div>
                            </div>
                            <div class="profile-details mb-5">
                                <button class="btn btn-primary">
                                    <i class="feather-plus me-2"></i>
                                    <span>ADD New</span>
                                </button>
                                <table id="example-1" class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Price</th>
                                            <th>Sale Price</th>
                                            <th>Quantity</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="hstack gap-3">
                                                    <div>
                                                        <a href="javascript:void(0);" class="d-block">iPhone</a>
                                                        <span class="fs-12 text-muted">Electronics </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="d-block mb-1">Brasil</a>
                                                <span class="fs-12 text-muted d-block">Code: PH</span>
                                            </td>
                                            <td>
                                                <a href="javascript:void(0);" class="d-block mb-1">05/28/2020</a>
                                                <span class="fs-12 text-muted d-block">Code: Paid</span>
                                            </td>
                                            <td>
                                                ádasds
                                            </td>
                                            <td>
                                                ádasds
                                            </td>
                                            <td class="text-end">
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-md">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-md">
                                                        <i class="feather-trash-2"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                            <div class="about-section mb-5">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0">List Image:</h5>
                                </div>
                            </div>
                            <div class="profile-details mb-5">
                                <button class="btn btn-primary">
                                    <i class="feather-plus me-2"></i>
                                    <span>ADD New</span>
                                </button>
                                <table id="example" class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>Product Name</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="hstack gap-3">
                                                    <div class="avatar-image avatar-lg rounded">
                                                        <img class="img-fluid w-5000" src="assets/images/gallery/4.png"
                                                            alt="">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end">
                                                <div class="hstack gap-2 justify-content-center align-item-center">
                                                    <a href="javascript:void(0);" class="avatar-text avatar-md">
                                                        <i class="feather-trash-2"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
