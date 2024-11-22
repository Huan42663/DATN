@extends('admin.master')

@section('title', 'Thêm Bài Viết')

@section('model', 'Post')

@section('function', 'Create')

@section('content')

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

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top-0">
                    <div class="tab-content">
                        <div class="card-body personal-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0 me-4">
                                    <span class="d-block mb-2">Create An Post</span>
                                </h5>
                            </div>
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
                                        <label for="fullnameInput" class="fw-semibold">Category Post </label>
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
                                        <label for="fullnameInput" class="fw-semibold">Image </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input class="form-control" type="file" name="image[]" id="image" multiple >
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Short Description </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <textarea name="short_description" id="short_description" cols="10" rows="3"  class="form-control" >{{old('title')}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Content </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <textarea name="content" id="content" cols="30" rows="10" class="form-control">{{old('title')}}</textarea>
                                        </div>
                                        @error('content')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
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
