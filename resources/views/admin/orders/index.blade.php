
@extends('admin.master')

@section('title', 'Order')
@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Orders</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">List</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
<div class="col-lg-12 mt-3" >
    <div class="card stretch stretch-full">
        <div class="card-body custom-card-action p-0">
            <div class="table-responsive" style="padding: 20px;">
                <table id="example" class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Order Code</th>
                            <th>Họ Tên</th>
                            <th>Số Điện Thoại</th>
                            <th>Email</th>
                            <th>Trạng Thái</th>
                            <th>Ngày Đặt</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $value )
                        <tr>
                            <td>
                                <span class="fs-12 text-muted d-block">{{$value->order_code}}</span>
                            </td>
                            <td>
                                <span  class="d-block mb-1">{{$value->fullname}}</span>
                            </td>
                            <td>
                                <span  class="d-block mb-1">{{$value->phone}}</span>
                            </td>
                            <td>
                                <span  class="d-block mb-1">{{$value->email}}</span>
                            </td>
                            <td>
                                @if ($value->status == "unconfirm")
                                    <span class="badge bg-soft-warning text-warning">Chờ Xác Nhận</span>
                                @elseif($value->status == "confirmed")
                                    <span class="badge bg-soft-success text-success">Đã Xác Nhận</span>
                                @elseif($value->status == "shipping")
                                    <span class="badge bg-soft-success text-success">Đang Vận Chuyển</span>
                                @elseif($value->status == "delivered")
                                    <span class="badge bg-soft-success text-success">Đã Giao Đến Khách Hàng</span>
                                @elseif($value->status == "received")
                                    <span class="badge bg-soft-warning text-warning">Đã Xác Nhận Nhận Hàng</span>
                                @elseif($value->status == "canceled")
                                     <span class="badge bg-soft-danger text-danger">Hủy</span>
                                @elseif($value->status == "return")
                                    <span class="badge bg-soft-dark text-dark">Trả Hàng</span>
                                @endif
                            </td>
                            <td>
                                <span class="d-block mb-1">{{ $value->created_at}}</span>
                            </td>
                            <td class="text-end">
                                <div class="hstack gap-2 justify-content-end">
                                    <a href="{{route('Administration.orders.show',$value->order_code)}}" class="avatar-text avatar-md">
                                        <i class="feather-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

