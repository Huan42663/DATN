@extends('admin.master')

@section('title', 'Cập Nhật Mã Khuyến Mại')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Vouchers</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">Cập Nhật</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top-0">
                    <div class="tab-content">
                        <div class="card-body personal-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0 me-4">
                                    <span class="d-block mb-2">Cập Nhật Khuyến Mãi</span>
                                </h5>
                            </div>
                            @if(session('success'))
                                <div class="alert alert-success mt-2" role="alert" >
                                    {{session('success')}}
                                </div>
                            @endif
                            <form action="{{route('Administration.vouchers.update',$data[0])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Mã Khuyến Mãi : </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="voucher_code" name="voucher_code"
                                                placeholder="Voucher Code Vd: jsstore123#1" value={{$data[0]->voucher_code}}>
                                        </div> @error('voucher_code')
                                        <span class="text-danger mt-1">
                                            {{$message}}
                                            </span>
                                        @enderror
                                        @if(session('error'))
                                            <span class="text-danger mt-1">
                                            {{session('error')}}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Kiểu Khuyến Mãi: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select name="type" class="form-control" id="type">
                                                <option value="0"@selected($data[0]->type==0)>Giảm Giá Theo %</option>
                                                <option value="1"@selected($data[0]->type==1)>Giảm Giá Theo Giá Tiền</option>
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
                                                placeholder="10% or 100.000đ" value={{$data[0]->value}}>
                                        </div>
                                        @error('value')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @if(session('error2'))
                                            <span class="text-danger mt-1">
                                            {{session('error2')}}
                                            </span>
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
                                                placeholder="10 - 20 .... 9999" value={{$data[0]->quantity}}>
                                        </div>
                                        @error('quantity')
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
                                            <input type="datetime-local" class="form-control" name="date_start" id="date_start" value={{date('Y-m-d\TH:i', strtotime($data[0]->date_start)) }}>
                                        </div>
                                        @error('date_start')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Ngày Kết Thúc: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="date_end" id="date_end" value={{date('Y-m-d\TH:i', strtotime($data[0]->date_end)) }}>
                                        </div>
                                        @if(session('error1'))
                                            <span class="text-danger mt-1">
                                            {{session('error1')}}
                                            </span>
                                        @endif
                                        @error('date_end')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                               <div class="d-flex">
                                    <button type="submit" class="btn btn-sm btn-light-brand me-2">Cập Nhật</button>
                                    <a href="{{route('Administration.vouchers.list')}}"><button type="button" class="btn btn-sm btn-primary">Danh sách voucher</button></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(session('errorUpdate'))
    <input type="text" hidden id="errorUpdate" value="{{session('errorUpdate')}}">
    @endif

    <script>
        const check = document.getElementById('errorUpdate');
        if(check){
            if(check.value !=""){
                swal({
                    icon: "error",
                    title: check.value,
                });
        }
        }
    </script>
@endsection
