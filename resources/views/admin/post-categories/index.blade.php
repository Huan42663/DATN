@extends('admin.master')

@section('title', 'Article category list')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Danh mục bài viết</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang chủ</a></li>
                <li class="breadcrumb-item">Danh sách </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 mt-3">
        <div class="card stretch stretch-full">
            <div class="card-body custom-card-action p-0">
                @if (session('success'))
                    <p class="bg-danger text-white p-2">{{ session('success') }}</p>
                @endif
                @if (session('message'))
                    <p class="bg-success text-white p-2">{{ session('message') }}</p>
                @endif
                <div class="table-responsive">
                    <a href="{{ route('Administration.categoryPost.create') }}" class=" btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>THÊM MỚI DANH MỤC BÀI VIẾT</span>
                    </a>
                    <div class="col-1">
                        <a href="{{ route('Administration.categoryPost.listDelete') }}" class=" btn btn-danger mt-2">
                            <i class="fa fa-trash"></i> Thùng rác
                        </a>
                    </div>
                    <table id="example" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Tên danh mục bài viết</th>
                                <th class="text-end">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category_post as $post)
                                <tr>
                                    <td>{{ $post->category_post_name }}</td>
                                    <td class="text-end">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{ route('Administration.categoryPost.edit', $post->category_post_id) }}"
                                                class="avatar-text avatar-md">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <form
                                                action="{{ route('Administration.categoryPost.destroy', $post->category_post_id) }}"
                                                method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button onclick="return confirm('Do you want to delete this category?') "
                                                    class="avatar-text avatar-md">
                                                    <i class="feather-trash-2"></i>
                                                    </i>
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
