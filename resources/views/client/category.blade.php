@extends('client.master')

@section('title', 'Danh Mục')

@section('content')
    <div class="container mt-5">

        <div class="row">
            <h1 class="text-center fs-3 fw-bold">Danh Sách Danh Mục Sản Phẩm</h1>
            <div class="row mt-5">
                @include('client.components.slidebar')
            </div>
            <div class="row  mt-3">
                <div class="row">
                    <h1></h1>
                </div>
                <div class="row">
                    @if (isset($products) && !empty($products))
                        <div class="whate-new-block">
                            <div class="container">
                                <div
                                    class="list-product hide-product-sold grid lg:grid-cols-4 grid-cols-2 sm:gap-[30px] gap-[20px]">
                                    @foreach ($products as $product)
                                        @include('client.categories.index', ['product' => $product])
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
