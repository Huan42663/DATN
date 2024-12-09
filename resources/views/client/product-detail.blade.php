@extends('client.master')

@section('title', 'chi tiết sản phẩm')

@section('content')
    <style>
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
    @php
        $listColor = [];
        $listSize = [];
        foreach ($product_variant as $item) {
            // dd($item->color_name);
            $listColor[] = [
                'color_name' => $item->color_name,
                'color_id' => $item->color_id,
            ];
        }
        foreach ($product_variant as $item) {
            $listSize[] = [
                'size_name' => $item->size_name,
                'size_id' => $item->size_id,
            ];
        }
        $listColorNew = collect($listColor)->unique('color_id')->all();
        $listSizeNew = collect($listSize)->unique('size_id')->all();
    @endphp
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_image }}"
                        class="">
                </div>
                <div class="row mt-3">
                    <p class="fs-4">
                        <b>Mô Tả Sản Phẩm :</b> {!! $product->description !!}
                    </p>
                </div>
                <div class="row mt-5">
                    <div class="d-flex row justify-content-center text-center">
                        <div class="col-4">
                            <p class="fs-4">Danh Mục</p>
                            <hr>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start">
                        @foreach ($product->categories as $item)
                            <div class="col-1">
                                <a href="#">
                                    <button>
                                        <span class="badge bg-opacity-10 text-success bg-success rounded-pill">
                                            {{ $item->category_name }}
                                        </span>
                                    </button>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <form id="form-add-cart" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                    <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                    <p class="fs-3">{{ $product->product_name }}</p>
                    <hr>
                    <h3 class="text-danger">
                        <span>{{ $product->min_price }} Đ</span>
                        <i>-</i>
                        <span>{{ $product->max_price }}</span>
                    </h3>
                    <p>
                        <b>Mô Tả :</b> {!! $product->description !!}
                    </p>

                    <div class="form-group mt-3">
                        <label for="color">Màu sắc:</label> <br>
                        @foreach ($listColorNew as $color)
                            <button type="button" class="btn btn-outline-secondary" name="color_id" id="buttonColor"
                                value="{{ $color['color_id'] }}"
                                data-color_id="{{ $color['color_id'] }}">{{ $color['color_name'] }}</button>
                        @endforeach
                    </div>
                    <div class="form-group mt-2" id="size-box">
                        <label for="size">Kích thước:</label> <br>
                        @foreach ($listSizeNew as $size)
                            <button type="button" class="btn btn-outline-secondary" name="size_id" id="button"
                                value="{{ $size['size_id'] }}"
                                data-size_id="{{ $size['size_id'] }}">{{ $size['size_name'] }}</button>
                        @endforeach
                    </div>
                    <div class="row d-flex justify-content-center">
                        <div class="mt-2 col-5 ">
                            <div class="input-group quantity">
                                <button type="button" class="input-group-text" data-type="minus" id="minus">
                                    <span class="glyphicon glyphicon-minus">-</span>
                                </button>
                                <input type="number" id="inputQuantity" class="form-control text-center" name="quantity"
                                    min="1" value="1">
                                <button type="button" class="input-group-text" data-type="plus" id="plus">
                                    <span class="glyphicon glyphicon-plus">+</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="size_id" id="size_id" value="">
                    <input type="hidden" name="color_id" id="color_id" value="">
                    <div class="mt-3 d-flex justify-content-center">
                        <button type="submit" id="submitBtn" class="btn btn-dark bg-dark">Thêm vào giỏ</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-5 row">
            <div class="d-flex row justify-content-center text-center">
                <div class="col-4 mb-4">
                    <p class="fs-4">Sản phẩm liên quan</p>
                    <hr>
                </div>
            </div>
            <div class="whate-new-block">
                <div class="container">
                    <div
                        class="list-product hide-product-sold grid lg:grid-cols-4 grid-cols-2 sm:gap-[30px] gap-[20px] md:mt-10 mt-6">

                        @if ($related_products != [])
                            @foreach ($related_products[0] as $product)
                                @include('client.components.whate-new-block', ['product' => $product])
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const minus = document.querySelector('#minus');
        const plus = document.querySelector('#plus');
        const quantity = document.getElementById('inputQuantity');
        const buttons = document.querySelectorAll('#button');
        const buttonColor = document.querySelectorAll('#buttonColor');
        const inp_color = document.getElementById('color_id');
        const inp_size = document.getElementById('size_id');
        const size = [];
        const color = [];
        minus.addEventListener('click', () => {
            quantity.value = quantity.value - 1;
            if (quantity.value <= 1) {
                quantity.value = 1;
            }
        });
        plus.addEventListener('click', () => {
            quantity.value = (parseInt(quantity.value) + 1);
            if (quantity.value >= 999) {
                quantity.value = 999;
            }
        });
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Kiểm tra xem nút hiện tại có đang active không
                const isButtonActive = button.classList.contains('active');
                // Xóa class active khỏi tất cả các nút
                buttons.forEach(btn => btn.classList.remove('active'));
                size[0] = null;
                // Nếu nút hiện tại chưa active thì thêm class active
                if (!isButtonActive) {
                    button.classList.add('active');
                    size[0] = button.value;
                }
                inp_size.value = size[0];
                console.log(inp_size);
            });
        });
        buttonColor.forEach(button => {
            button.addEventListener('click', () => {
                // Kiểm tra xem nút hiện tại có đang active không
                const isButtonActive = button.classList.contains('active');
                // Xóa class active khỏi tất cả các nút
                buttonColor.forEach(btn => btn.classList.remove('active'));
                color[0] = null;
                // Nếu nút hiện tại chưa active thì thêm class active
                if (!isButtonActive) {
                    button.classList.add('active');
                    color[0] = button.value;
                }
                inp_color.value = color[0];
                console.log(inp_color);
            });
        });
        $(document).ready(function() {
            $('#submitBtn').click(function() {
                var formData = $('#form-add-cart').serialize(); // Chuyển dữ liệu form thành chuỗi
                document.getElementById('form-add-cart').addEventListener('submit', function(event) {
                    event.preventDefault();
                });
                $.ajax({
                    url: '/create/cart', // Đường dẫn đến controller
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Xử lý khi gửi thành công
                        console.log(response);
                    },
                    error: function(error) {
                        // Xử lý khi gửi thất bại
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
