@extends('client.master')

@section('title', 'Chi Tiết Sản Phẩm')

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
                    <div id="carouselExample" class="carousel slide">
                        <div class="carousel-inner">
                            @if(isset($product_images))
                                @php
                                    $i=0;
                                    foreach ($product_images as $item ):
                                @endphp
                                @if($i == 0)
                                    <div class="carousel-item @if($i==0) active @endif">
                                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_image }}" class="d-block w-100" style="width: 200px; height:650px;">
                                    </div>
                                @else
                                    <div class="carousel-item">
                                        <img style="width: 200px; height:650px;" src="{{asset('storage/'.$item->image_color_name)}}" class="d-block w-100" alt="...">
                                    </div>
                                @endif

                                @php
                                    $i++;
                                    endforeach;
                                @endphp
                            @else
                            <div class="carousel-item active">
                                <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_image }}" class="d-block w-100" style="width: 200px; height:650px;">
                              </div>
                            @endif
                            
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
                    
                    
                </div>
                <div class="row mt-3">
                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link @if(!isset($_GET['page'])) active @endif" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Mô Tả Sản Phẩm</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link  @if(isset($_GET['page']))active @endif" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Đánh giá</button>
                        </li>
                    </ul>
                        <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade @if(!isset($_GET['page']))show active @endif " id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">{!! $product->description !!}</div>
                        <div class="tab-pane fade @if(isset($_GET['page']))show active @endif " id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">
                            <div class="">
                                @if(isset($rates))
                                @foreach ($rates as $item )
                                <div class="card mt-1">
                                    <div class="card-header">
                                        {{"Họ và Tên : ".$item->fullName}}
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title d-flex">
                                        @for ($i = 0; $i < $item->star; $i++)
                                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png " width="15" height="15" alt="" title="" class="img-small me-1">
                                        @endfor
                                        @for ($i = 0; $i < 5 -  $item->star; $i++)
                                            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828970.png " width="15" height="15" alt="" title="" class="img-small me-1">
                                        @endfor
                                        </h5>
                                        <div class="row d-flex ">
                                            @if(isset($rate_images))
                                                @foreach ($rate_images as $item1 )
                                                    @if($item->rate_id == $item1->rate_id )
                                                        <img src="{{asset('storage/'.$item1->image_name)}}" alt="" title="" class="img-small me-1" style="width:150px ;">
                                                    @endif
                                                @endforeach
                                            @endif
                                        </div>
                                        <p class="card-text mt-1">{{"Nội dung :" .$item->content}}</p>
                                    </div>
                                    </div>
                                @endforeach
                                @endif
                            </div>
                            {{$rates->links()}}
                        </div>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="d-flex row mb-3">
                        <div class="col-4">
                            <p class="fw-bold fs-4">Danh Mục</p>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-start">
                        @foreach ($product->categories as $item)
                            <div class="col-1">
                                <a href="{{route('Client.product.category',$item->category_slug)}}">
                                    <button>
                                        <h5>
                                            <span class="badge bg-opacity-10 text-success bg-success rounded-pill fs-6">
                                                {{ $item->category_name }}
                                            </span>
                                        </h5>
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
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->product_id }}">
                    <p class="fs-3 lh-1">{{ $product->product_name }}</p>
                    <hr class="mt-1">
                    @if(isset($rates))
                    @php
                        $check = 0;
                        foreach ($rates as $key ) {
                           $check += $key->star;
                        }
                        if($check == 0){
                            $rate =0;
                        }else{
                            $rate = $check/count($rates);
                        }
                    @endphp
                        <div class="sapo-product-reviews-star d-flex mt-2">
                            @for ($i = 0; $i <  floor( $rate); $i++)
                                    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828884.png " width="15" height="15" alt="" title="" class="img-small me-1">
                            @endfor
                            @for ($i = 0; $i < 5 -( floor( $rate)); $i++)
                                <img src="https://cdn-icons-png.flaticon.com/512/1828/1828970.png " width="15" height="15" alt="" title="" class="img-small me-1">
                            @endfor
                        </div>
                    @endif
                    <h3 class=" mt-2" id="price">
                        @if ($product->min_price == $product->max_price)
                            <span class="fs-5 fw-bold text-danger"> {{number_format($product->min_price, 0, ',', '.') . ' VNĐ';}} </span>
                        @else
                        <span class="fs-5 fw-bold text-danger"> {{number_format($product->min_price, 0, ',', '.') . ' VNĐ';}} </span>
                        <i>-</i>
                        <span class="fs-5 fw-bold text-danger">{{number_format($product->max_price, 0, ',', '.') . ' VNĐ';}}</span>
                        @endif
                    </h3>
                    <input type="hidden" id="max_price" value="{{$product->max_price}}">
                    <input type="hidden" id="min_price" value="{{$product->min_price}}">
                    {{-- @if($product->max_price != $product->sale_price_check)
                        <h4 class="mt-2">
                            <del><span class="fs-5 fw-bold"> {{number_format($product->min_price, 0, ',', '.') . ' VNĐ';}} </span></del>
                        </h4>
                    @endif --}}
                    <p class="mt-2">
                        <b>Mô Tả :</b> {!! substr($product->description, 0, 200) !!}
                    </p>
                    <div class="form-group mt-2" id="size-box">
                        <label for="size">Kích thước:</label> <br>
                        @foreach ($listSizeNew as $size)
                            <button type="button" class="btn btn-outline-dark" name="size_id" id="button"
                                value="{{ $size['size_id'] }}"
                                data-size_id="{{ $size['size_id'] }}">{{ $size['size_name'] }}</button>
                        @endforeach
                    </div>

                    <div class="form-group mt-3">
                        <label for="color">Màu sắc:</label> <br>
                        @foreach ($listColorNew as $color)
                            <button type="button" class="btn btn-outline-dark" name="color_id" id="buttonColor"
                                value="{{ $color['color_id'] }}"
                                data-color_id="{{ $color['color_id'] }}">{{ $color['color_name'] }}</button>
                        @endforeach
                    </div>
                    
                    <div class="row d-flex">
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

                        <div id="quantityCheck" class="mt-2 mb-2">
                            <span class="fs-6">Số lượng sản phẩm còn trong kho là : {{$product1}}</span>
                        </div>

                    </div>
                    <input type="hidden" name="size_id" id="size_id" value="">
                    <input type="hidden" name="color_id" id="color_id" value="">
                    <div class="mt-3 d-flex">
                        <button type="button" id="submitBtn" class="btn btn-primary bg-primary" style="width:100%; height:50px;font-size:20px" >Thêm vào giỏ hàng</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-5 row">
            <div class="d-flex row justify-content-center text-center mb-3">
                <div class="col-4 mb-4">
                    <p class="fw-bold fs-4 text-capitalize">Sản phẩm liên quan</p>
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
    <input type="hidden" id="usercheck" @if(Auth::check()) value = "true" @else value="false" @endif>
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
        const product_id = $('#product_id').val();
        console.log(product_id);
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
        function ReadyPrice(){
                $(document).ready(function(){
                var min_price = $('#min_price').val();
                var max_price = $('#max_price').val();
                if(inp_color.value == "" && inp_size.value == ""){
                    if (min_price == max_price ){
                        $('#price').html(`<span class="fs-5 fw-bold text-danger">${Intl.NumberFormat('vi').format(max_price)} VNĐ</span>`)
                    }
                    else{
                        $('#price').html(`<span class="fs-5 fw-bold text-danger">${Intl.NumberFormat('vi').format(min_price)} VNĐ </span>
                        <i>-</i>
                        <span class="fs-5 fw-bold text-danger">${Intl.NumberFormat('vi').format(max_price)} VNĐ </span>`)
                        
                    }        
                }
            })
        }
        setInterval(ReadyPrice, 2000)
        buttons.forEach(button => {
            button.addEventListener('click', () => {
                // Kiểm tra xem nút hiện tại có đang active không
                const isButtonActive = button.classList.contains('active');
                // Xóa class active khỏi tất cả các nút
                buttons.forEach(btn => btn.classList.remove('active'));
                inp_size.value  = "";
                // Nếu nút hiện tại chưa active thì thêm class active
                if (!isButtonActive) {
                    button.classList.add('active');
                    size[0] = button.value;
                    inp_size.value = size[0];
                    const size_id = $('#size_id').val();
                    const color_id = $('#color_id').val();
                    getQuantity(product_id, size_id, color_id)
                }
            });
        });
        buttonColor.forEach(button => {
            button.addEventListener('click', () => {
                // Kiểm tra xem nút hiện tại có đang active không
                const isButtonActive = button.classList.contains('active');
                // Xóa class active khỏi tất cả các nút
                buttonColor.forEach(btn => btn.classList.remove('active'));
                inp_color.value  = "";
                // Nếu nút hiện tại chưa active thì thêm class active
                if (!isButtonActive) {
                    button.classList.add('active');
                    color[0] = button.value;
                    inp_color.value = color[0];
                    const size_id = $('#size_id').val();
                    const color_id = $('#color_id').val();
                    getQuantity(product_id, size_id, color_id)
                }
            });
        });
        url = "{{route('Client.product.getQuantity')}}";
        function getQuantity(product_id, size_id, color_id){
            
                $.ajax({
                url: url, 
                type: 'POST',
                data: {
                    _token : $('meta[name="csrf-token"]').attr('content'),
                    product_id: product_id,
                    size_id:  size_id,
                    color_id: color_id
                },
                success: function(response) {
                    console.log(response.data);
                        $('#quantityCheck').html(`<span class="fs-6"> ${response.data}</span>`);
                        if(response.sale_price == null){
                            $('#price').html(`<span class="fs-5 fw-bold text-danger">${Intl.NumberFormat('vi').format(response.price)} VNĐ </span>`)

                        }else{
                            $('#price').html(`<span class="fs-5 fw-bold text-danger">${Intl.NumberFormat('vi').format(response.sale_price)} VNĐ </span> <br> <del> <span class="text-secondary">${Intl.NumberFormat('vi').format(response.price)} VNĐ</del>`)
                        }
                        // console.log(response);
                        if(response.quantity ==0){
                            $("#submitBtn").prop("disabled", true);
                        }else{
                            $("#submitBtn").prop("disabled", false);
                        }
                },
                error: function(error) {
                    const price = $('#max_price').val();
                    const sale_price = $('#min_price').val();
                    // console.log(error.responseJSON.data);
                    $('#quantityCheck').html(`<span class="fs-6">${error.responseJSON.data}</span>`);
                    if(Number(price) > Number(sale_price)){
                        $('#price').html(`<span class="fs-5 fw-bold text-danger"> ${Intl.NumberFormat('vi').format(sale_price)} VNĐ</span><i> - </i><span class="fs-5 fw-bold text-danger">${Intl.NumberFormat('vi').format(price)} VNĐ</span>`);
                    }else{
                        $('#price').html(`<span class="fs-5 fw-bold text-danger"> ${Intl.NumberFormat('vi').format(price)} VNĐ</span>`);

                    }
                    $("#submitBtn").prop("disabled", true);

                }
            });
        }
        $(document).ready(function() {
            $('#submitBtn').click(function() {
                const userCheck = $('#usercheck').val();
                    if(userCheck == "true"){
                        console.log(userCheck);
                        var formData = $('#form-add-cart').serialize(); // Chuyển dữ liệu form thành chuỗi
                        document.getElementById('form-add-cart').addEventListener('submit', function(event) {
                            event.preventDefault();
                        });
                            $.ajax({
                                url: '/create/cart', // Đường dẫn đến controller
                                type: 'POST',
                                data: formData,
                                success: function(response) {
                                    swal({
                                    icon: "success",
                                    title: response.data,
                                    });
                                    $('#countCart').html(response.countCart)
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    swal({
                                    icon: "error",
                                    title: jqXHR.responseJSON.data,
                                    });
                                }
                            });
                        } 
                    else{
                        swal({
                        icon: "error",
                        title: "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng"
                        });
                        console.log(userCheck);
                    }
            });
        });
    </script>
@endsection
