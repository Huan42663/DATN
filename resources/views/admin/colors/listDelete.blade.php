@extends('admin.master')

@section('title', 'Khôi phục Màu')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Màu </h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang chủ </a></li>
                <li class="breadcrumb-item">Khôi Phục</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
<div class="col-lg-12 mt-1">
    <div class="card stretch stretch-full">
        <div class="card-body custom-card-action p-0">
            <div class="table-responsive" style="padding: 20px;">
                <form action="{{route('Administration.colors.updateDelete')}}" method="POST">
                @csrf
                <table id="example" class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>STT</th>
                            <th>Tên Màu </th>
                            <th>Ngày Xóa</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $i=1;
                        foreach ($color as $value ):
                        @endphp
                            <tr>
                                <td><input type="checkbox" name="color_id[]" value="{{$value->color_id}}"></td>
                                <td>
                                    <span class="d-block mb-1">{{$i}}</span>
                                </td>
                                <td>
                                    <span class="d-block mb-1">{{$value->color_name}}</span>
                                </td>
                                <td>
                                    <span class="d-block mb-1">{{$value->deleted_at}}</span>
                                </td>
                            </tr>
                        @php
                        $i++;
                        endforeach
                        @endphp
                        
                    </tbody>
                </table>
                <div class="d-flex">
                    <button class="btn btn-success me-2" type="submit" onclick="return confirm('bạn có muốn khôi phục những màu này không')">Khôi Phục</button>
                    <a href="{{route('Administration.colors.list')}}"><button class="btn btn-primary" type="button">Danh Sách</button></a>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
