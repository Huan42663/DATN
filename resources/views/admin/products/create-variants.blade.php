@extends('admin.master')

@section('title', 'thêm sự kiện')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Products</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ Back() }}">Create</a></li>
                <li class="breadcrumb-item">Create Variants</li>
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
                                    <span class="d-block mb-2">Variants :</span>
                                </h5>
                            </div>
                            <form action="" enctype="multipart/form-data">
                                <div class="row mb-4 align-items-center">
                                    <table class="table" id="example">
                                        <thead>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>Price</th>
                                            <th>Price Sale</th>
                                            <th>Quantity</th>
                                            <th>Delete</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="d-block mb-2 fs-22">30</span></td>
                                                <td><span class="d-block mb-2 fs-22">red</span></td>
                                                <td><input type="text" class="form-control" name="" value="10000"
                                                        id=""></td>
                                                <td><input type="text" class="form-control" value="9000" name=""
                                                        id=""></td>
                                                <td><input type="text" class="form-control" value="50" name=""
                                                        id=""></td>
                                                <td>
                                                    <a href="javascript:void(0);" class="avatar-text avatar-md">
                                                        <i class="feather-trash-2"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <button type="submit" class="btn btn-lg btn-light-brand">Add</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
