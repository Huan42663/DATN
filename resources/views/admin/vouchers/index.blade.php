
@extends('admin.master')

@section('title', 'Vouchers')
@section('model', 'Vouchers')
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

<div class="col-lg-12 mt-3" >
    <div class="card stretch stretch-full">
        <div class="card-body custom-card-action p-0">
            <a href="{{route('Administration.vouchers.create')}}" style="padding: 20px; "><button class="btn btn-primary" style="margin-left:20px;">Thêm mới</button></a>
            <div class="table-responsive" style="padding: 20px;">
                <table id="example" class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>VoucherCode</th>
                            <th>Kiểu Giảm</th>
                            <th>Giá Trị</th>
                            <th>quantity</th>
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
                                            {{$value->value."VND"}}
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
                                        <form action="{{route('Administration.vouchers.destroy', $value)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="avatar-text avatar-md" type="submit" onclick="return confirm('Bạn có muốn xóa voucher này không?')">
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

