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
        // dd($product_variant)
        foreach ($product_variant as $item) {
            $listColor[] = [
                'color_name' => $item->color_name,
                'color_id' => $item->color_id,
            ];
        }
        $listColorNew = collect($listColor)->unique('color_id')->all();
        foreach ($product_variant as $item) {
            $listSize[] = [
                'size_name' => $item->size_name,
                'size_id' => $item->size_id,
            ];
        }
        $listSizeNew = collect($listSize)->unique('size_id')->all();
    @endphp
    <div class="container mt-5" style="font-family: calibri">
        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <img src="{{ asset('storage/images/products/' . $product->product_image) }}"
                        alt="{{ $product->product_image }}" class="img-fluid">
                </div>
                <div class="row">
                    <p>
                        <b>Mô Tả Sản Phẩm :</b> {!! $product->description !!}
                    </p>
                </div>
                <div class="row mt-5">
                    <div class="d-flex row justify-content-center text-center">
                        <div class="col-4">
                            <h3>Danh Mục</h3>
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
            <div class="col-md-4">
                <form action="{{ route('Client.cart.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                    <input type="hidden" name="product_name" value="{{ $product->product_id }}">
                    <h2>{{ $product->product_name }}</h2>
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
                    <div class="mt-2">
                        <div class="input-group quantity">
                            <button type="button" class="input-group-text" data-type="minus" id="minus">
                                <span class="glyphicon glyphicon-minus">-</span>
                            </button>
                            <input type="number" id="inputQuantity" class="form-control" name="quantity" min="1"
                                value="1">
                            <button type="button" class="input-group-text" data-type="plus" id="plus">
                                <span class="glyphicon glyphicon-plus">+</span>
                            </button>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-dark bg-dark">Thêm vào giỏ</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-5 row">
            <div class="d-flex row justify-content-center text-center">
                <div class="col-4">
                    <h1>Sản phẩm liên quan</h1>
                    <hr>
                </div>
            </div>
            @foreach ($related_products[0] as $item)
                <div class="col-3 bg-secondary bg-opacity-10 rounded m-1">
                    <div class="row">
                        <img src="" alt="adsdasdas" class="img-fluid">
                    </div>
                    <div class="row">
                        <a class="text-decoration-none text-dark"
                            href="{{ route('Client.product.detail', $item->product_slug) }}">
                            <b>{{ $item->product_name }}</b>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="row mt-5 mb-5">
            <div class="d-flex row justify-content-center text-center">
                <div class="col-4">
                    <h1>Đánh giá sản phẩm</h1>
                    <hr>
                </div>
            </div>

            <div class="container">

                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        @foreach ($rates as $item)
                            <div class="card mb-3">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="path/to/image.jpg" class="img-fluid rounded-start" alt="...">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $item->fullName }}</h5>
                                            <p class="card-text">{{ $item->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group" id="comment-list">
                                </ul>

                                <form id="comment-form">
                                    <div class="form-group">
                                        <textarea class="form-control" id="comment" rows="3" placeholder="Viết bình luận của bạn..."></textarea>
                                        <button type="submit" class="btn bg-primary btn-primary">Gửi</button>
                                    </div>
                                </form>
                            </div>
                        </div>
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
        const size = [];
        const color = [];
        minus.addEventListener('click', () => {
            quantity.value = quantity.value - 1;
            if (quantity.value <= 0) {
                quantity.value = 0;
            }
        });
        plus.addEventListener('click', () => {
            quantity.value = (parseInt(quantity.value) + 1);
        });
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Kiểm tra xem nút hiện tại có đang active không
                const isButtonActive = button.classList.contains('active');

                // Xóa class active khỏi tất cả các nút
                buttons.forEach(btn => btn.classList.remove('active'));

                // Nếu nút hiện tại chưa active thì thêm class active
                if (!isButtonActive) {
                    button.classList.add('active');
                    if (size[0] == null) {
                        size.push(button.value);
                    } else {
                        size.shift()
                        size.push(button.value);
                    }

                    console.log(size[0]);
                }
            });
        });
        buttonColor.forEach(button => {
            button.addEventListener('click', () => {
                // Kiểm tra xem nút hiện tại có đang active không
                const isButtonActive = button.classList.contains('active');

                // Xóa class active khỏi tất cả các nút
                buttonColor.forEach(btn => btn.classList.remove('active'));

                // Nếu nút hiện tại chưa active thì thêm class active
                if (!isButtonActive) {
                    button.classList.add('active');
                    if (color[0] == null) {
                        color.push(button.value);
                    } else {
                        color.shift()
                        color.push(button.value);
                    }
                    console.log(color[0]);
                }
            });
        });
    </script>
@endsection
