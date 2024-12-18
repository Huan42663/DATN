
@extends('client.master')

@section('title','Cảm Ơn')

@section('content')
            <style>
                .success-animation {
                     margin:20px auto;
                     height: 200px;
                    }
                .checkmark {
                    width: 100px;
                    height: 100px;
                    border-radius: 50%;
                    display: block;
                    stroke-width: 2;
                    stroke: #4bb71b;
                    stroke-miterlimit: 10;
                    box-shadow: inset 0px 0px 0px #4bb71b;
                    animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
                    position:relative;
                    top: 5px;
                    right: 5px;
                margin: 0 auto;
                }
                .checkmark__circle {
                    stroke-dasharray: 166;
                    stroke-dashoffset: 166;
                    stroke-width: 2;
                    stroke-miterlimit: 10;
                    stroke: #4bb71b;
                    fill: #fff;
                    animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
                
                }
            
                .checkmark__check {
                    transform-origin: 50% 50%;
                    stroke-dasharray: 48;
                    stroke-dashoffset: 48;
                    animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
                }
            
                @keyframes stroke {
                    100% {
                        stroke-dashoffset: 0;
                    }
                }
            
                @keyframes scale {
                    0%, 100% {
                        transform: none;
                    }
            
                    50% {
                        transform: scale3d(1.1, 1.1, 1);
                    }
                }
            
                @keyframes fill {
                    100% {
                        box-shadow: inset 0px 0px 0px 30px #4bb71b;
                    }
                }
            </style>
    <div class="mt-5" style="background-color: #fff" >
        <div class="row ">
            <p class="fw-bold fs-3 text-success mt-3 mb-3 text-center">ĐẶT HÀNG THÀNH CÔNG</p>
            <div class="success-animation ">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" /><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" /></svg>
            </div>
            <p class="fw-bold fs-5 text-primary text-capitalize text-center">Cảm ơn bạn đã tin tương đặt hàng của chúng tôi</p>
            <p class="fw-bold fs-5 text-primart text-capitalize text-center mt-1">Chúng tôi sẽ xác nhận đơn hàng của bạn trong thời gian sớm nhất. Trân Trọng!</p>
        </div>
        <div class="container mt-5 mb-3">
            @if (isset($products) && !empty($products))
            <p class="fw-bold fs-3 text-center  text-capitalize  mb-3">sản phẩm mới </p>
            <div class="whate-new-block" >
                <div class="container">
                    <div class="list-product hide-product-sold grid lg:grid-cols-4 grid-cols-2 sm:gap-[30px] gap-[20px]">
                        @foreach ($products as $product)
                            @include('client.components.whate-block',['product'=>$product])
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
