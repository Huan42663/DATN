@extends('admin.master')

@section('title', 'danh sách danh mục bài viết')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Category Post</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
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
                @session('massage')
                    <p class="bg-success">{{ $massage }}</p>
                @endsession
                <div class="table-responsive">
                    <a href="{{ route('Administration.categoryPost.create') }}" class=" btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>ADD NEW CATEGORY POST</span>
                    </a>
                    <table id="example" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Tên Danh Mục</th>
                                <th class="text-end">Actions</th>
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
                                                <button onclick="return confirm('bạn có muốn xóa danh mục này ?') "
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
    <!-- [Recent Orders] end -->
@endsection
