@extends('client.master')

@section('title', 'Chi tiết')

@section('content')
    <div class="container">


        <div class="row">
            <!-- Sidebar: Hiển thị danh sách danh mục -->
            <h1 class="text-center fs-3 fw-bold">Sản phẩm trong danh mục: {{ $category->category_name }}</h1>
            <div class="row mt-5">
                @include('client.components.slidebar')
            </div>

            <!-- Main Content: Hiển thị sản phẩm trong danh mục -->
            <div class="col-md-9">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-md-4">
                            <div class="product-item grid-type style-1">
                                <a href="{{ route('Client.product.detail', $product->product_slug) }}">
                                    <div class="product-main cursor-pointer block">
                                        <!-- Thumbnail Image -->
                                        <div class="product-thumb bg-white relative overflow-hidden rounded-2xl">
                                            <div class="product-img w-full h-full aspect-[3/4]">
                                                <img alt="{{ $product->product_name }}"
                                                    src="{{ asset('storage/' . $product->product_image) }}"
                                                    class="w-full h-full object-cover duration-700"
                                                    style="color:transparent" />
                                            </div>


                                            <!-- Product Actions: View more -->
                                            <div
                                                class="list-action grid grid-cols-2 gap-3 px-5 absolute w-full bottom-5 max-lg:hidden">
                                                <div class="quick-view-btn w-full text-button-uppercase py-2 text-center rounded-full duration-300"
                                                    style="color:white;background-color:black;padding-top:3px;">
                                                    <a href="{{ route('Client.product.detail', $product->product_slug) }}">Xem
                                                        Thêm</a>
                                                </div>
                                            </div>

                                            <!-- Product Actions: For mobile -->
                                            <div
                                                class="list-action-icon flex items-center justify-center gap-2 absolute w-full bottom-3 z-[1] lg:hidden">
                                                <a href="{{ route('Client.product.detail', $product->product_slug) }}">
                                                    <div
                                                        class="quick-view-btn w-9 h-9 flex items-center justify-center rounded-lg duration-300 bg-white hover:bg-black hover:text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                            height="1em" fill="currentColor" viewBox="0 0 256 256">
                                                            <path
                                                                d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Z" />
                                                        </svg>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="product-infor mt-4 lg:mb-7">
                                            <div class=" text-title duration-300">{{ $product->product_name }}</div>
                                            <div class="flex items-center gap-2 flex-wrap mt-1 duration-300 relative z-[1]">
                                                <div class="product-price text-title">
                                                    @if ($product->minPrice > 0)
                                                        {{ number_format($product->minPrice, 0, ',', '.') . 'VNĐ' }}
                                                    @else
                                                        {{ number_format($product->maxPrice, 0, ',', '.') . 'VNĐ' }}
                                                    @endif
                                                </div>
                                                <div class="product-origin-price caption1 text-secondary2"><del>
                                                        @if ($product->minPrice > 0)
                                                            {{ number_format($product->maxPrice, 0, ',', '.') . 'VNĐ' }}
                                                        @endif
                                                    </del>
                                                </div>
                                                @if ($product->minPrice > 0 && $product->maxPrice > 0)
                                                    <div
                                                        class="product-sale caption1 font-medium bg-green px-3 py-0.5 inline-block rounded-full">
                                                        {{ (($product->maxPrice - $product->minPrice) / $product->maxPrice) * 100 . '%' }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
