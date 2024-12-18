@extends('admin.master')

@section('title', 'Danh Mục Sản Phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10"> Danh mục sản phẩm </h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang chủ </a></li>
                <li class="breadcrumb-item">Danh sách </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 mt-3">
        <div class="card stretch stretch-full">
            <div class="card-body custom-card-action p-0">
                @if (session('message'))
                    <p class="bg-success text-white p-2">{{ session('message') }}</p>
                @endif

                <div class="mb-3">
                    <a href="{{ route('Administration.categoryProduct.create') }}" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Thêm danh mục </span>
                    </a>
                    <div class="col-1">
                        <a href="{{ route('Administration.categoryProduct.listDelete') }}" class=" btn btn-danger mt-2">
                            <i class="fa fa-trash"></i> Thùng rác
                        </a>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="example" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên danh mục </th>
                                <th>Danh mục cha </th>
                                <th class="text-end">Hành động </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key => $category)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>
                                        <strong>{{ $category->category_name }}</strong>
                                    </td>
                                    <td>
                                        {{ $category->parent ? $category->parent->category_name : 'No' }}
                                    </td>
                                    <td class="text-end">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{ route('Administration.categoryProduct.edit', $category->category_id) }}"
                                                class="avatar-text avatar-md text-primary">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('Administration.categoryProduct.destroy', $category->category_id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Bạn có muốn xóa danh mục này không?')"
                                                    class="avatar-text avatar-md text-danger">
                                                    <i class="feather-trash-2"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
