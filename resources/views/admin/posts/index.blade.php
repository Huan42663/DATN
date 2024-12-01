
@extends('admin.master')

@section('title', 'Posts')
@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Posts</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">List</li>
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
<div class="col-lg-12 mt-3" >
    <div class="card stretch stretch-full">
        <div class="card-body custom-card-action p-0">
            <form action="{{route('Administration.posts.destroy')}}" method="post">
                @csrf
                @method('DELETE')
            <div class="table-responsive" style="padding: 20px;">
                <table id="example" class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>STT</th>
                            <th>Title</th>
                            <th>Danh Mục</th>
                            <th>Ngày Đăng</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                         $i=1;
                        foreach ($posts as $value ):
                        @endphp
                             <tr>
                                <td><input type="checkbox" name="post_id[]" value="{{$value->post_id}}"></td>
                                <td>
                                    <span  class="d-block mb-1">{{$i}}</span>
                                </td>
                                <td>
                                    <span  class="d-block mb-1">{{$value->title}}</span>
                                </td>
                                <td>
                                    @if(isset($value->categoryPost->category_post_name))
                                    <span  class="d-block mb-1">{{$value->categoryPost->category_post_name}}</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="d-block mb-1">{{ $value->created_at}}</span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{route('Administration.posts.show', $value->slug)}}" class="avatar-text avatar-md">
                                            <i class="feather-eye"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                         
                        @php
                        $i++;
                        endforeach
                        @endphp
                        
                    </tbody>
                </table>
                <button class="btn btn-danger mb-3" type="submit" onclick="return confirm('Bạn có muốn xóa những bài viết này không?')">
                    Xóa Bài Viết
                </button>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

