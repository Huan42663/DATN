@extends('admin.master')

@section('title', 'Thêm Sự Kiện')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Category Product</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">Create</li>
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
                                    <span class="d-block mb-2">Thêm Danh Mục Sản Phẩm:</span>
                                </h5>
                            </div>
                            <form action="{{ route('Administration.categoryProduct.store') }}" method="POST">
                                @csrf
                                @method('POST')

                                {{-- Input Tên danh mục --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="category_name" class="fw-semibold">Tên Danh mục: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="category_name"
                                                value="{{ old('category_name') }}" id="category_name"
                                                placeholder="Nhập tên danh mục">
                                        </div>
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Chọn danh mục cha --}}
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="category_parent_id" class="fw-semibold">Chọn danh mục cha (Nếu
                                            có):</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <table id="example" class="table" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Tên danh mục</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($category_product as $category)
                                                    <tr>
                                                        <td>
                                                            <input type="radio" name="category_parent_id"
                                                                value="{{ $category->category_id }}"
                                                                @if (old('category_parent_id') == $category->category_id) checked @endif>
                                                        </td>
                                                        <td>{{ $category->category_name }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @error('category_parent_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Nút thêm mới --}}
                                <button type="submit" class="btn btn-lg btn-light-brand">Thêm Mới</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
