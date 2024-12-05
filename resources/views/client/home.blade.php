@extends('client.master')

@section('title')

@section('content')
    <div class="whate-new-block">
        <div class="container">
            @if (isset($Banner) && !empty($Banner))
                <div id="carouselExample" class="carousel slide mt-3">
                    <div class="carousel-inner">
                        @php
                            $i=0;
                            foreach ($Banner as $item):
                        @endphp

                            <div class="carousel-item @if ($i == 0) {{ 'active' }} @endif">
                                <a href="{{ $item->link }}"><img src="{{ asset('storage/' . $item->image_name) }}"
                                        class="d-block w-100" alt="{{$item->image_name }}" style="height: 600px;"></a>
                            </div>
                         @php
                                $i++;
                            endforeach;
                        @endphp
                        
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @endif
            <div class="heading flex flex-col items-center text-center md:pt-5 pt-10">
                <div class="heading3"> NEW </div>
            </div>
            <div
                class="list-product hide-product-sold grid lg:grid-cols-4 grid-cols-2 sm:gap-[30px] gap-[20px] md:mt-10 mt-6">
                @if (isset($productNew) && !empty($productNew))
                    @foreach ($productNew as $product)
                        @include('client.components.whate-new-block', ['product' => $product])
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="whate-new-block md:pt-5 pt-10">
        <div class="container">
            <div class="heading flex flex-col items-center text-center">
                <div class="heading3"> HOT </div>
            </div>
            <div
                class="list-product hide-product-sold grid lg:grid-cols-4 grid-cols-2 sm:gap-[30px] gap-[20px] md:mt-10 mt-6">
                @if (isset($Product_hot) && !empty($Product_hot))
                    @foreach ($Product_hot as $product)
                        @include('client.components.whate-hot-block', ['product' => $product])
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="heading3 text-center"> EVENT </div>
        <div class="banner-block style-one grid sm:grid-cols-2 gap-5 md:pt-20 pt-10" style="padding: 20px">
            @if (isset($events) && !empty($events))
                @foreach ($events as $event)
                    @include('client.components.banner-block', ['event' => $event])
                @endforeach
            @endif
        </div>
    </div>
    @if (session('success'))
        <input type="hidden" id="OrderSuccess" value="{{ session('success') }}" >
    @endif
    {{-- @if (isset($_SESSION['access']) )
    <input type="hidden" id="OrderSuccess" value="{{  $_SESSION['access'] }}">
    @endif --}}
    <script>
        const order = document.getElementById('OrderSuccess');
        console.log(order.value);
        $(document).ready(function () {
            $('#OrderSuccess').val(order.value);
            console.log(document.getElementById('OrderSuccess').value);
            alert(document.getElementById('OrderSuccess').value);
        });
        const carousel = new bootstrap.Carousel('#carouselExampleIndicators');
        // if (order.value != "") {
           
        // }

    </script>
    
    @endsection
