@extends('admin.master')

@section('title', 'Sửa Bài Viết')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Bài viết </h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang chủ </a></li>
                <li class="breadcrumb-item">Cập Nhật</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
@if(session('success'))
<div class="alert alert-success mt-1" role="alert" >
   {{session('success')}}
</div>
@endif
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top-0">
                    <div class="tab-content">
                        <div class="card-body personal-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0 me-4">
                                    <span class="d-block mb-2">Cập Nhật Bài Viết</span>
                                </h5>
                            </div>
                            <form action="{{route('Administration.posts.update',$post[0])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Tiêu đề: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Nhập tiêu đề bài viết" 
                                                @if (isset($_SESSION['data']['title']))
                                                    value = "{{$_SESSION['data']['title']}}"
                                                @elseif (old('title'))
                                                    value="{{old('title')}}"
                                                @else
                                                    value="{{$post[0]->title}}"
                                                @endif
                                                >
                                        </div>
                                        @error('title')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @if(session('title'))
                                        <span class="text-danger">{{session('title')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Danh Mục </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select name="category_post_id" class="form-control" id="">
                                                @foreach ($categoryPost as $value)
                                                    <option value="{{$value->category_post_id}}"
                                                        @if(isset($_SESSION['data']['category_post_id']))
                                                            @selected($value->category_post_id == $_SESSION['data']['category_post_id'])
                                                        @elseif (old('category_post_id'))
                                                            @selected($value->category_post_id == old('category_post_id'))
                                                        @else
                                                            @selected($value->category_post_id == $post[0]->category_post_id)
                                                        @endif
                                                        >{{$value->category_post_name}}</option>
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
                                        <label for="fullnameInput" class="fw-semibold">Hình Ảnh </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input  class="form-control" type="file" name="image[]" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Danh Sách Ảnh </label>
                                    </div>
                                   
                                    <div class="col-lg-8">
                                        @if(!empty($post[0]->PostImage))
                                            @foreach ($post[0]->PostImage as $key )
                                                <img src="{{asset('storage/'.$key->image_name)}}" alt="{{$key->image_name}}" width="250" height="300">
                                            @endforeach
                                        @else
                                        <label for="fullnameInput" class="fw-semibold">Không có ảnh </label>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Mô Tả Ngắn </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <textarea name="short_description" id="short_description" cols="10" rows="3"  class="form-control">@if(isset($_SESSION['data']['short_description'])) {{$_SESSION['data']['short_description']}} @elseif(!empty(old('short_description'))){{old('short_description')}}@else{{$post[0]->short_description}} @endif</textarea>
                                        </div>
                                        @error('short_description')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Nội Dung </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <textarea name="content" id="editor" cols="30" rows="10" class="form-control">@if(isset($_SESSION['data']['content'])) {{$_SESSION['data']['content']}} @elseif(!empty(old('content'))){{old('content')}}@else{{$post[0]->content}} @endif</textarea>
                                        </div>
                                        @error('content')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-sm btn-light-brand me-2">Cập Nhật</button>
                                    <a href="{{route('Administration.posts.list')}}"><button type="button" class="btn btn-sm btn-success">Danh sách bài viết</button></a>
                                </div>
                            </form>
                            <form action="{{route('Administration.posts.destroyImage',$post[0])}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger mb-3 mt-2" type="submit">Xóa Toàn Bộ Ảnh</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
