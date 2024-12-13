
@extends('admin.master')

@section('title', 'Vouchers')
@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Vouchers</h5>
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

<div class="col-lg-12 mt-3" >
    <div class="card stretch stretch-full">
        <div class="card-body custom-card-action p-0">
            <div class="mb-3">
                <a href="{{ route('Administration.vouchers.create') }}" class="btn btn-primary">
                    <i class="feather-plus me-2"></i>
                    <span>Thêm Mã Khuyến Mãi Mới</span>
                </a>
            </div>
            <form action="{{route('Administration.vouchers.destroy')}}" method="post">
                @csrf
                @method('DELETE')
                <div class="table-responsive" style="padding: 20px;">
                    <table id="example" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th></th>
                                <th>STT</th>
                                <th>Mã Khuyến Mãi</th>
                                <th>Kiểu Giảm</th>
                                <th>Giá Trị</th>
                                <th>Số Lượng</th>
                                <th>Ngày Bắt Đầu</th>
                                <th>Ngày Kết Thúc</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $i=1;
                            foreach ($data as $value ):
                            @endphp
                                <tr>
                                    <td><input type="checkbox" name="voucher_id[]" value="{{$value->voucher_code}}"></td>
                                    <td>
                                        <span  class="d-block mb-1">{{$i}}</span>
                                    </td>
                                    <td>
                                        <span  class="d-block mb-1">{{$value->voucher_code}}</span>
                                    </td>
                                    <td>
                                        <span  class="d-block mb-1">{{$value->type}}</span>
                                    </td>
                                    <td>
                                        <span  class="d-block mb-1">
                                            @if ($value->value > 100 )
                                                {{number_format($value->value, 0, ',', '.') . 'VNĐ';}}
                                            @else
                                                {{$value->value."%"}}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <span  class="d-block mb-1">{{$value->quantity}}</span>
                                    </td>
                                    <td>
                                        <span  class="d-block mb-1">{{$value->date_start}}</span>
                                    </td>
                                    <td>
                                        <span  class="d-block mb-1">{{$value->date_end}}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="{{route('Administration.vouchers.show', $value->voucher_code)}}" class="avatar-text avatar-md">
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
                    <button class="btn btn-danger mb-3" type="submit" onclick="return confirm('Bạn có muốn xóa những voucher này không?')">
                       Xóa Voucher
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

