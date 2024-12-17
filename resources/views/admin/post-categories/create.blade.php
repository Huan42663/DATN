@extends('admin.master')

@section('title', 'thêm sự kiện')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Danh Mục Bài Viết</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item">Thêm mới</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-content">

        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top-0">
                    @if (session('error'))
                        <p class="bg-danger text-white p-2">{{ session('error') }}</p>
                    @endif
                    <div class="tab-content">
                        <div class="card-body personal-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0 me-4">
                                    <span class="d-block mb-2">Thêm danh mục bài viết:</span>
                                </h5>
                            </div>
                            <form action="{{ route('Administration.categoryPost.store') }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="category_post_name" class="fw-semibold">Tên danh mục: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Nhập tên danh mục"
                                                name="category_post_name" value="{{ old('category_post_name') }}"
                                                id="category_post_name">
                                        </div>
                                        @error('category_post_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="category_post_name" class="fw-semibold">Hiển thị đầu trang: </label>
                                    </div>
                                    <div class="col-lg-8">

                                        <input type="checkbox" name="showHeader" {{ old('showHeader') ? 'checked' : '' }}>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="category_post_name" class="fw-semibold">Hiển thị chân trang:
                                        </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">

                                            <input type="checkbox" name="showFooter"
                                                {{ old('showFooter') ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-lg btn-light-brand">Thêm mới</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
