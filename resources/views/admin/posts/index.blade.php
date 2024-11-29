
@extends('admin.master')

@section('title', 'Posts')
@section('model', 'Posts')
@section('function', 'List')

@section('content')
@if(session('success'))
<div class="alert alert-success mt-1" role="alert" >
   {{session('success')}}
</div>
@endif
<div class="col-lg-12 mt-3" >
    <div class="card stretch stretch-full">
        <div class="card-body custom-card-action p-0">
            <div class="table-responsive" style="padding: 20px;">
                <table id="example" class="table table-hover mb-0">
                    <thead>
                        <tr>
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
                                <td>
                                    <span  class="d-block mb-1">{{$i}}</span>
                                </td>
                                <td>
                                    <span  class="d-block mb-1">{{$value->title}}</span>
                                </td>
                                <td>
                                    <span  class="d-block mb-1">{{$value->categoryPost->category_post_name}}</span>
                                </td>
                                <td>
                                    <span class="d-block mb-1">{{ $value->created_at}}</span>
                                </td>
                                <td class="text-end">
                                    <div class="hstack gap-2 justify-content-end">
                                        <a href="{{route('Administration.posts.show', $value->slug)}}" class="avatar-text avatar-md">
                                            <i class="feather-eye"></i>
                                        </a>
                                        <form action="{{route('Administration.posts.destroy', $value)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="avatar-text avatar-md" type="submit" onclick="return confirm('Bạn có muốn xóa bài viết này không?')">
                                                <i class="feather-trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                         
                        @php
                        $i++;
                        endforeach
                        @endphp
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

