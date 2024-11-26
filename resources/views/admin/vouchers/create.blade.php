@extends('admin.master')

@section('title', 'Thêm Voucher')

@section('model', 'Voucher')

@section('function', 'Create')

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
                                    <span class="d-block mb-2">Create An Voucher</span>
                                </h5>
                            </div>
                            <form action="{{route('Administration.vouchers.store')}}" method="POST">
                                @csrf
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Voucher Code : </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="voucher_code" name="voucher_code"
                                                placeholder="Voucher Code Vd: jsstore123#1" 
                                                @if(isset($data[0]->voucher_code))
                                                    value="{{$data[0]->voucher_code}}"
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
                                        <label for="fullnameInput" class="fw-semibold">Type Voucher: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <select name="type" class="form-control" id="type">
                                                <option value="0"@if(isset($data[0]->type)) @selected($data[0]->type == 0) @endif @selected(old('type') ==0)>Giảm Giá Theo %</option>
                                                <option value="1" @if(isset($data[0]->type)) @selected($data[0]->type == 1) @endif @selected(old('type') ==1)>Giảm Giá Theo Giá Tiền</option>
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
                                                placeholder="10% or 100.000đ" 
                                                @if(isset($data[0]->value))
                                                    value="{{$data[0]->value}}"
                                                @elseif(old('value'))
                                                    value="{{old('value')}}"
                                                @endif>
                                        </div>
                                        @error('value')
                                                <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @if (session('value'))
                                            <span class="text-danger">{{session('value')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Quantity :</label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="quantity" name="quantity"
                                                placeholder="10 - 20 .... 9999"
                                                @if(isset($data[0]->quantity))
                                                    value="{{$data[0]->quantity}}"
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
                                        <label for="fullnameInput" class="fw-semibold">Date Start: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="date_start" id="date_start" 
                                            @if(isset($data[0]->date_start))
                                                    value="{{$data[0]->date_start}}"
                                                @elseif(old('date_start'))
                                                    value="{{old('date_start')}}"
                                                @endif>
                                        </div>
                                        @error('date_start')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @if(session('date_start'))
                                            <span class="text-danger">{{session('date_start')}}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row mb-4 align-items-center">
                                    <div class="col-lg-4">
                                        <label for="fullnameInput" class="fw-semibold">Date End: </label>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="input-group">
                                            <input type="datetime-local" class="form-control" name="date_end" id="date_end" 
                                            @if(isset($data[0]->date_end))
                                                    value="{{$data[0]->date_end}}"
                                                @elseif(old('date_end'))
                                                    value="{{old('date_end')}}"
                                                @endif
                                            >
                                        </div>
                                        @error('date_end')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @if(session('date_end'))
                                            <span class="text-danger">{{session('date_end')}}</span>
                                        @endif
                                    </div>
                                </div>
                               
                                <button type="submit" class="btn btn-sm btn-light-brand">Add New</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
