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
                    <p class="fs-3 lh-1">{{ $product->product_name }}</p>
                    <hr>
                    <h3 class="text-danger">
                        <span class="fs-5 fw-bold"> {{number_format($product->min_price, 0, ',', '.') . ' VNĐ';}} </span>
                        <i>-</i>
                        <span class="fs-5 fw-bold">{{number_format($product->max_price, 0, ',', '.') . ' VNĐ';}}</span>
                    </h3>
                    <p>
                        <b>Mô Tả :</b> {!! substr($product->description, 0, 200) !!}
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
                                <div class="product-item grid-type style-1">
                                    <a href="{{ route('Client.product.detail', $product->product_slug) }}">
                                        <div class="product-main cursor-pointer block">
                                            <div class="product-thumb bg-white relative overflow-hidden rounded-2xl">
                                                <div
                                                    class="product-tag text-button-uppercase bg-green px-3 py-0.5 inline-block rounded-full absolute top-3 left-3 z-[1]">
                                                    New</div>
                                                <div class="product-img w-full h-full aspect-[3/4]">
                                                    <img alt="Raglan Sleeve T-shirt" fetchPriority="high" width="500"
                                                        height="500" decoding="async" data-nimg="1"
                                                        class="w-full h-full object-cover duration-700"
                                                        style="color:transparent"
                                                        srcSet="{{ asset('storage/' . $product->product_image) }} 1x, {{ asset('storage/' . $product->product_image) }} 2x"
                                                        src="{{ asset('storage/' . $product->product_image) }}" />
                                                    <img alt="Raglan Sleeve T-shirt" fetchPriority="high" width="500"
                                                        height="500" decoding="async" data-nimg="1"
                                                        class="w-full h-full object-cover duration-700"
                                                        style="color:transparent"
                                                        srcSet="{{ asset('storage/' . $product->product_image) }} 1x, {{ asset('storage/' . $product->product_image) }} 2x"
                                                        src="{{ asset('storage/' . $product->product_image) }}" />
                                                </div>
                                                <div
                                                    class="list-action grid grid-cols-2 gap-3 px-5 absolute w-full bottom-5 max-lg:hidden">
                                                    <div class="quick-view-btn w-full text-button-uppercase py-2 text-center rounded-full duration-300"
                                                        style="color:white;background-color:black;padding-top:3px ">
                                                        <a
                                                            href="{{ route('Client.product.detail', $product->product_slug) }}">Xem
                                                            Thêm</a>
                                                    </div>
                                                </div>
                                                <div
                                                    class="list-action-icon flex items-center justify-center gap-2 absolute w-full bottom-3 z-[1] lg:hidden">
                                                    <a
                                                        href="{{ route('Client.product.detail', $product->product_slug) }}">
                                                        <div
                                                            class="quick-view-btn w-9 h-9 flex items-center justify-center rounded-lg duration-300 bg-white hover:bg-black hover:text-white">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="1em"
                                                                height="1em" fill="currentColor" viewBox="0 0 256 256"
                                                                class="text-lg">
                                                                <path
                                                                    d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-infor mt-4 lg:mb-7">
                                                <div class=" text-title duration-300">{{ $product->product_name }}</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
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
                        alert('Thêm sản phẩm vào giỏ hàng thành công');
                    },
                    error: function(error) {
                        alert('Thêm sản phẩm vào giỏ hàng that bai vui long thu lai');
                        // Xử lý khi gửi thất bại
                        console.error(error);
                    }
                });
            });
        });
    </script>
@endsection
