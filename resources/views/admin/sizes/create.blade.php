@extends('admin.master')

@section('title', 'Thêm Size')

@section('model', 'Size')

@section('function', 'Create')

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top-0">
                    <div class="tab-content">
                        <div class="card-body personal-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0 me-4">
                                    <span class="d-block mb-2">Create An Event:</span>
                                </h5>
                            </div>
                            <form action="">
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Size Name: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="size_name" name="size_name"
                                                placeholder="Size Name">
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-light-brand">Add New</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
