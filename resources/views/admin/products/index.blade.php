@extends('admin.master')

@section('title', 'danh sách sản phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Products</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('home') }}">Home</a></li>
                <li class="breadcrumb-item">List</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <!-- [Recent Orders] start -->
    <div class="col-lg-12 mt-3">
        <div class="card stretch stretch-full">
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <a href="customers-create.html" class=" btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Create Event</span>
                    </a>
                    <table id="example" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Product Image</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg rounded">
                                            <img class="img-fluid" src="assets/images/gallery/4.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">iPhone 14 Pro Max</a>
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
                                    ádasdsadasdsada
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg rounded">
                                            <img class="img-fluid" src="assets/images/gallery/4.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">iPhone 14 Pro Max</a>
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
                                    ádasdsadasdsada
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-eye"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-edit"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="hstack gap-3">
                                        <div class="avatar-image avatar-lg rounded">
                                            <img class="img-fluid" src="assets/images/gallery/4.png" alt="">
                                        </div>
                                        <div>
                                            <a href="javascript:void(0);" class="d-block">iPhone 14 Pro Max</a>
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
                                    ádasdsadasdsada
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="javascript:void(0);" class="avatar-text avatar-md">
                                            <i class="feather-eye"></i>
                                        </a>
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
        </div>
    </div>
    <!-- [Recent Orders] end -->
@endsection
