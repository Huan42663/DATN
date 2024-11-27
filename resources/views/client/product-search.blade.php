@extends('client.master')

@section('title',"Tim Kiem")

@section('content')
<div class="container mt-5">
    <div class="row">
        <h3 class="fw-bold">Kết quả tìm kiếm cho : {{$_GET['keyword']}}</h3>
    </div>
    <div class="row  mt-3">
        <div class="row">
            @include('client.components.slidebar')
        </div>
        <div class="row">
            @if (isset($products) && !empty($products) && count($products)>0)
            <div class="whate-new-block" >
                <div class="container">
                    <div class="list-product hide-product-sold grid lg:grid-cols-4 grid-cols-2 sm:gap-[30px] gap-[20px]">
                        @foreach ($products as $product)
                        @include('client.components.whate-new-block',['product'=>$product])
                    @endforeach
                        
                    </div>
                </div>
            </div>
            @else
                <h3 class="fw-medium">Không tìm thấy sản phẩm </h3>
            @endif
            
        </div>
    </div>
    
</div>
@endsection
