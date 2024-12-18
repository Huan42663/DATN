@extends('admin.master')

@section('title', 'Cập Nhât')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Danh mục sản phẩm  </h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang chủ </a></li>
                <li class="breadcrumb-item">Cập nhật </li>
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
                                    <span class="d-block mb-2">Cập nhật danh mục sản phẩm:</span>
                                </h5>
                            </div>
                            <form action="{{ route('Administration.categoryProduct.update', $categories->category_id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="category_name" class="fw-semibold">Tên danh mục: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="category_name"
                                                value="{{ old('category_name', $categories->category_name) }}"
                                                id="category_name" required>
                                        </div>
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="category_parent_id" class="fw-semibold">Danh mục cha: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="category_parent_id" id="category_parent_id">
                                            <option value="">-- Không có danh mục cha --</option>
                                            @foreach ($listCategoryProduct as $item)
                                                <option value="{{ $item->category_id }}"
                                                    {{ old('category_parent_id', $categories->category_parent_id) == $item->category_id ? 'selected' : '' }}>
                                                    {{ $item->category_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_parent_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
