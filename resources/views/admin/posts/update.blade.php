@extends('admin.master')

@section('title', 'Sửa Bài Viết')

@section('model', 'Post')

@section('function', 'Update')

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
                                    <span class="d-block mb-2">Update An Post</span>
                                </h5>
                            </div>
                            <form action="{{route('Administration.posts.update',$post[0])}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Title: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Title vd: Hello World I'am JS Store" 
                                                @if (old('title'))
                                                    value="{{old('title')}}"
                                                @else
                                                    value="{{$post[0]->title}}"
                                                @endif
                                                >
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Category Post </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select name="category_post_id" class="form-control" id="">
                                                @foreach ($categoryPost as $value)
                                                    <option value="{{$value->category_post_id}}"
                                                        @if (old('category_post_id'))
                                                            @selected($value->category_post_id == old('category_post_id'))
                                                        @else
                                                            @selected($value->category_post_id == $post[0]->category_post_id)
                                                        @endif
                                                        >{{$value->category_post_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Image </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input  class="form-control" type="file" name="image[]" multiple>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Image </label>
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
                                        <label for="fullnameInput" class="fw-semibold">Short Description </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <textarea name="short_description" id="short_description" cols="10" rows="3"  class="form-control">@if(!empty(old('short_description'))){{old('short_description')}}@else{{$post[0]->short_description}} @endif</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Content </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <textarea name="content" id="content" cols="30" rows="10" class="form-control">@if(!empty(old('content'))){{old('content')}}@else{{$post[0]->content}} @endif</textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-sm btn-light-brand">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
