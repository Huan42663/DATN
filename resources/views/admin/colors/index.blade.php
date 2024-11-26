@extends('admin.master')

@section('title', 'Colors')
@section('model', 'Colors')
@section('function', 'List')

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

    <div class="row mt-2">
        <div class="col-lg-12">
            <div class="card border-top-0">
                <div class="tab-content">
                    <div class="card-body personal-info">
                        <div class="mb-4 d-flex align-items-center justify-content-between">
                            <h5 class="fw-bold mb-0 me-4">
                                @if(isset($ColorInfo) && !empty($ColorInfo))
                                <span class="d-block mb-2">Sửa Màu </span>
                                @else
                                <span class="d-block mb-2">Thêm Màu </span>
                                @endif
                                
                            </h5>
                        </div>
                        @if(isset($ColorInfo) && !empty($ColorInfo))
                        <form action="{{route('Administration.colors.update',$ColorInfo[0])}}" method="post">
                            @method('PUT')
                        @else
                        <form action="{{route('Administration.colors.store')}}" method="post">
                        @endif
                            @csrf
                            <div class="row mb-4 align-items-center">
                                <div class="col-lg-4">
                                    <label for="fullnameInput" class="fw-semibold">Tên Màu: </label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="color_name" name="color_name"
                                            placeholder="Tên Màu" 
                                            @if(isset($ColorInfo) && !empty($ColorInfo)) 
                                                value="{{$ColorInfo[0]->color_name}}"
                                            @else
                                                value="{{old('color_name')}}"
                                            @endif
                                            >
                                    </div>
                                    @error('color_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @if(isset($error))
                                        <span class="text-danger">{{$error}}</span>
                                    @endif
                                </div>
                                
                            </div>
                            @if(isset($ColorInfo) && !empty($ColorInfo))
                            <button type="submit" class="btn btn-sm btn-light-brand">Sửa</button>
                            @else
                            <button type="submit" class="btn btn-sm btn-light-brand">Thêm Mới</button>
                            @endif
                           
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 mt-1">
        <div class="card stretch stretch-full">
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive" style="padding: 20px;">
                    <table id="example" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên Màu </th>
                                <th>Ngày Đăng</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            foreach ($data as $value ):
                            @endphp
                                <tr>
                                    <td>
                                        <span class="d-block mb-1">{{$i}}</span>
                                    </td>
                                    <td>
                                        <span class="d-block mb-1">{{$value->color_name}}</span>
                                    </td>
                                    <td>
                                        <span class="d-block mb-1">{{$value->created_at}}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{route('Administration.colors.show',$value->color_id)}}" class="avatar-text avatar-md">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <form action="{{route('Administration.colors.destroy', $value)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="avatar-text avatar-md" type="submit" onclick="return confirm('Bạn có muốn xóa màu này không?')">
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
