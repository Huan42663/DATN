@extends('admin.master')

@section('title', 'Cập Nhật Danh Mục Sản Phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Cập Nhật Danh Mục Sản Phẩm</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">Update</li>
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
                                    <span class="d-block mb-2">Cập Nhật Danh Mục Sản Phẩm:</span>
                                </h5>
                            </div>
                            <form action="{{ route('Administration.categoryProduct.update', $categories->category_id) }}"
                                method="POST">
                                @csrf
                                @method('PUT')

                                {{-- Tên danh mục --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="category_name" class="fw-semibold">Tên Danh mục: </label>
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

                                {{-- Danh mục cha --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="category_parent_id" class="fw-semibold">Danh Mục Cha: </label>
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

                                {{-- Nút submit --}}
                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
