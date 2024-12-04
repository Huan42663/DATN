@extends('admin.master')

@section('title', 'Sizes')
@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Sizes</h5>
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
                                @if(isset($SizeInfo) && !empty($SizeInfo))
                                <span class="d-block mb-2">Sửa Size </span>
                                @else
                                <span class="d-block mb-2">Thêm Size </span>
                                @endif
                                
                            </h5>
                        </div>
                        @if(isset($SizeInfo) && !empty($SizeInfo))
                        <form action="{{route('Administration.sizes.update',$SizeInfo[0])}}" method="post">
                            @method('PUT')
                        @else
                        <form action="{{route('Administration.sizes.store')}}" method="post">
                        @endif
                            @csrf
                            <div class="row mb-4 align-items-center">
                                <div class="col-lg-4">
                                    <label for="fullnameInput" class="fw-semibold">Tên Size: </label>
                                </div>
                                <div class="col-lg-8">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="size_name" name="size_name"
                                            placeholder="Size Name" 
                                            @if(isset($SizeInfo) && !empty($SizeInfo)) 
                                                value="{{$SizeInfo[0]->size_name}}"
                                            @else
                                                value="{{old('size_name')}}"
                                            @endif
                                            >
                                    </div>
                                    @error('size_name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                    @if(isset($error))
                                        <span class="text-danger">{{$error}}</span>
                                    @endif
                                </div>
                                
                            </div>
                            @if(isset($SizeInfo) && !empty($SizeInfo))
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
                <div class="row" style="padding: 20px">
                    <a href="{{route('Administration.sizes.delete')}}"><button class="btn btn-danger"><i class="bi bi-trash3 me-2"></i>Thùng Rác</button></a>
                </div>
                <form action="{{route('Administration.sizes.destroy')}}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="table-responsive" style="padding: 20px;">
                        <table id="example" class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>STT</th>
                                    <th>Size Name </th>
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
                                        <td><input type="checkbox" name="size_id[]" value="{{$value->size_id}}"></td>
                                        <td>
                                            <span class="d-block mb-1">{{$i}}</span>
                                        </td>
                                        <td>
                                            <span class="d-block mb-1">{{$value->size_name}}</span>
                                        </td>
                                        <td>
                                            <span class="d-block mb-1">{{$value->created_at}}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{route('Administration.sizes.show',$value->size_id)}}" class="avatar-text avatar-md">
                                                    <i class="feather-edit"></i>
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
                    </div>
                    <div class="" style="padding: 20px">
                        <button class="btn btn-danger mb-3" type="submit" onclick="return confirm('Bạn có muốn xóa những size này không?')">
                            {{-- <i class="feather-trash-2"></i> --}}
                            Xóa Size
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
