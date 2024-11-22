@extends('admin.master')

@section('title', 'Update Voucher')

@section('model', 'Voucher')

@section('function', 'Update')

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

    <div class="main-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top-0">
                    <div class="tab-content">
                        <div class="card-body personal-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0 me-4">
                                    <span class="d-block mb-2">Update An Voucher</span>
                                </h5>
                            </div>
                            <form action="{{route('Administration.vouchers.update',$data[0])}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Voucher Code : </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="voucher_code" name="voucher_code"
                                                placeholder="Voucher Code Vd: jsstore123#1" value={{$data[0]->voucher_code}}
                                                >
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Type Voucher: </label>
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
                                        <label for="fullnameInput" class="fw-semibold">Value :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="value" name="value"
                                                placeholder="10% or 100.000đ" value={{$data[0]->value}}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Quantity :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                placeholder="10 - 20 .... 9999" value={{$data[0]->quantity}}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Date Start: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="date_start" id="date_start" value={{date('Y-m-d\TH:i', strtotime($data[0]->date_start)) }}>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Date End: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="date_end" id="date_end" value={{date('Y-m-d\TH:i', strtotime($data[0]->date_end)) }}>
                                        </div>
                                    </div>
                                </div>
                               
                                <button type="submit" class="btn btn-sm btn-light-brand">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
