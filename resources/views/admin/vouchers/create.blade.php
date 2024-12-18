@extends('admin.master')

@section('title', 'Thêm Mã Khuyến Mại')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Vouchers</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">Thêm Mới</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')

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
                                    <span class="d-block mb-2">Thêm Mới Khuyến Mãi</span>
                                </h5>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success mt-1" role="alert" >
                                    {{session('success')}}
                                </div>
                            @endif
                            <form action="{{route('Administration.vouchers.store')}}" method="POST">
                                @csrf
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Mã Khuyến Mãi: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="voucher_code" name="voucher_code"
                                                placeholder="Voucher Code Vd: jsstore123#1" 
                                                @if(isset($data['voucher_code']))
                                                    value="{{$data['voucher_code']}}"
                                                @elseif(old('voucher_code'))
                                                    value="{{old('voucher_code')}}"
                                                @endif
                                                >
                                            </div>
                                            @error('voucher_code')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Kiểu Khuyến Mãi: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select name="type" class="form-control" id="type">
                                                <option value="0"@if(isset($data['type'])) @selected($data['type'] == 0) @endif @selected(old('type') ==0)>Giảm Giá Theo %</option>
                                                <option value="1" @if(isset($data['type'])) @selected($data['type'] == 1) @endif @selected(old('type') ==1)>Giảm Giá Theo Giá Tiền</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Giá Trị :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="value" name="value"
                                                placeholder="10% or 100.000đ" 
                                                @if(isset($data['value']))
                                                    value="{{$data['value']}}"
                                                @elseif(old('value'))
                                                    value="{{old('value')}}"
                                                @endif>
                                        </div>
                                        @error('value')
                                                <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @if(isset($data3))
                                            <span class="text-danger">{{$data3}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Số Lượng :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                placeholder="10 - 20 .... 9999"
                                                @if(isset($data['quantity']))
                                                    value="{{$data['quantity']}}"
                                                @elseif(old('quantity'))
                                                    value="{{old('quantity')}}"
                                                @endif
                                                >
                                        </div>
                                        @error('number')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Ngày Bắt Đầu: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="date_start" id="date_start" 
                                            @if(isset($data['date_start']))
                                                    value="{{$data['date_start']}}"
                                                @elseif(old('date_start'))
                                                    value="{{old('date_start')}}"
                                                @endif>
                                        </div>
                                        @error('date_start')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @if(isset($data1))
                                            <span class="text-danger">{{$data1}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Ngày Kết Thúc: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="date_end" id="date_end" 
                                            @if(isset($data['date_end']))
                                                    value="{{$data['date_end']}}"
                                                @elseif(old('date_end'))
                                                    value="{{old('date_end')}}"
                                                @endif
                                            >
                                        </div>
                                        @error('date_end')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @if(isset($data2))
                                            <span class="text-danger">{{$data2}}</span>
                                        @endif
                                    </div>
                                </div>
                               
                                <div class="d-flex">
                                    <button type="submit" class="btn btn-sm btn-light-brand me-2">Thêm Mới</button>
                                    <a href="{{route('Administration.vouchers.list')}}"><button type="button" class="btn btn-sm btn-primary">Danh sách voucher</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
