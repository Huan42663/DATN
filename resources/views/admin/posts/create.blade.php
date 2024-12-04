@extends('admin.master')

@section('title', 'Thêm Bài Viết')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Posts</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">Thêm Mới</li>
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
                                    <span class="d-block mb-2">Thêm Bài Viết Mới</span>
                                </h5>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success mt-1" role="alert" >
                                {{session('success')}}
                                </div>
                                @endif
                                @if(session('error'))
                                <div class="alert alert-danger mt-1" role="alert" >
                                {{session('error')}}
                                </div>
                                @endif
                            <form action="{{route('Administration.posts.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Title </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Title vd: Hello World I'am JS Store" value="{{old('title')}}">
                                        </div>
                                        @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Danh Mục</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select name="category_post_id" class="form-control" id="">
                                                @foreach ($categoryPost as $value )
                                                    <option value="{{$value->category_post_id}}" @selected($value->category_post_id == old('category_post_id')) >{{$value->category_post_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('category_post_id')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Ảnh </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input class="form-control" type="file" name="image[]" id="image" multiple >
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Mô Tả Ngắn</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group"">
                                            <textarea name="short_description"  cols="10" rows="3"  class="form-control" >{{old('title')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Nội Dung </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="">
                                            <textarea id="editor" name="content" rows="10" data-auto-grow="false" >{{old('title')}}</textarea>
                                        </div>
                                        {{-- <div class="input-group">
                                            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{old('title')}}</textarea>
                                        </div> --}}
                                        @error('content')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-sm btn-light-brand me-2">Thêm Mới</button>
                                    <a href="{{route('Administration.posts.list')}}"><button type="button" class="btn btn-sm btn-primary">Danh sách bài viết</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
