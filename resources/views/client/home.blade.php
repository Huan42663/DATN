@extends('client.master')

@section('title')

@section('content')
    <div class="whate-new-block" >
        <div class="container">
                <div id="carouselExample" class="carousel slide mt-3"  >
                    <div class="carousel-inner">
                    @foreach ($Banner as $item )
                    <div class="carousel-item @if($item->banner_id==1){{'active'}}@endif">
                    <img src="{{asset('storage/'.$item->image_name)}}" class="d-block w-100" alt="..." style="height: 600px;">
                    </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                </div>
            <div class="heading flex flex-col items-center text-center mt-3">
                <div class="heading3"> NEW </div>
            </div>
            <div class="list-product hide-product-sold grid lg:grid-cols-4 grid-cols-2 sm:gap-[30px] gap-[20px] md:mt-10 mt-6">
                @foreach ($productNew as $product)
                     @include('client.components.whate-new-block',['product'=>$product])
                @endforeach
                
            </div>
        </div>
    </div>
    <div class="whate-new-block md:pt-5 pt-10" >
        <div class="container">
            <div class="heading flex flex-col items-center text-center">
                <div class="heading3"> HOT </div>
            </div>
            <div class="list-product hide-product-sold grid lg:grid-cols-4 grid-cols-2 sm:gap-[30px] gap-[20px] md:mt-10 mt-6">
                @foreach ($Product_hot as $product)
                     @include('client.components.whate-hot-block',['product'=>$product])
                @endforeach
                
            </div>
        </div>
    </div>
    <br>
    <div class="heading3 text-center" > EVENT </div>
    <div class="banner-block style-one grid sm:grid-cols-2 gap-5 md:pt-20 pt-10" style="padding: 20px" >
        @foreach ($events as $event )
            @include('client.components.banner-block',['event'=>$event])
        @endforeach
    </div>
    <div class="text-center" style="margin-bottom:10px"><a href="{{route('events.index')}}"> Xem Thêm Event -> </a></div>
    

    {{-- @include('client.components.collection-block')

    @include('client.components.tab-features-block') --}}

    {{-- @include('client.components.banner-block')  --}}

    {{-- @include('client.components.container')

    @include('client.components.testimonial-block')

    @include('client.components.brand-block') --}} 
    <script>
        const carousel = new bootstrap.Carousel('#carouselExampleIndicators')
    </script>
@endsection
