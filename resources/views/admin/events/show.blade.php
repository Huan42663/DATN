@extends('admin.master')

@section('title', 'thêm sự kiện')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Events</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('home') }}">Home</a></li>
                <li class="breadcrumb-item">Show</li>
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
                        <div class="mb-4 d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0">Event name:</h5>
                        </div>
                        <table class="table">
                            <tr>
                                <th>date start </th>
                                <td>123123144asd</td>
                            </tr>
                            <tr>
                                <th>date end</th>
                                <td>123123144asd</td>
                            </tr>
                            <tr>
                                <th>type event</th>
                                <td>123123144asd</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-xxl-8 col-xl-6">
                <div class="card border-top-0">
                    <div class="tab-content">
                        <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                            <div class="about-section mb-5">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0">List Products in Event:</h5>
                                </div>
                            </div>
                            <div class="profile-details mb-5">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr class="">
                                                <td><input type="checkbox"></td>
                                                <td scope="row">Name</td>
                                                <td>Image</td>
                                            </tr>
                                            <tr class="">
                                                <td><input type="checkbox"></td>
                                                <td scope="row">Name</td>
                                                <td>Image</td>
                                            </tr>
                                            <tr class="">
                                                <td><input type="checkbox"></td>
                                                <td scope="row">Name</td>
                                                <td>Image</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-5 d-flex align-items-center justify-content-between">
                                    <a href="javascript:void(0);" class=" btn btn-light-brand">
                                        <i class="feather-trash-2 me-2"></i>
                                        <span>Delete</span>
                                    </a>
                                </div>
                            </div>
                            <div class="about-section mb-5">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0">ADD Products into Event:</h5>
                                </div>
                            </div>
                            <div class="profile-details mb-5">
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr class="">
                                                <td><input type="checkbox"></td>
                                                <td scope="row">Name</td>
                                                <td>Image</td>
                                            </tr>
                                            <tr class="">
                                                <td><input type="checkbox"></td>
                                                <td scope="row">Name</td>
                                                <td>Image</td>
                                            </tr>
                                            <tr class="">
                                                <td><input type="checkbox"></td>
                                                <td scope="row">Name</td>
                                                <td>Image</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mb-5 d-flex align-items-center justify-content-between">
                                    <a href="customers-create.html" class="btn btn-primary">
                                        <i class="feather-plus me-2"></i>
                                        <span>ADD</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
