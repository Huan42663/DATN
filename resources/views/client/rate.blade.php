@extends('client.master')

@section('title','Đánh Giá')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    /* Rating Star Widgets Style */
    .rating-stars ul {
        list-style-type:none;
        padding:0;
        
        -moz-user-select:none;
        -webkit-user-select:none;
    }
    .rating-stars ul > li.star {
        display:inline-block;
    
    }

    /* Idle State of the stars */
    .rating-stars ul > li.star > i.fa {
        font-size:2.5em; /* Change the size of the stars */
        color:#ccc; /* Color on idle state */
    }

    /* Hover state of the stars */
    .rating-stars ul > li.star.hover > i.fa {
        color:#FFCC36;
    }

    /* Selected state of the stars */
    .rating-stars ul > li.star.selected > i.fa {
        color:#FF912C;
    }
</style>
<h1 class="mt-5 mb-3 text-center fs-3 fw-bold">Đánh Giá</h1>

    <div class="mt-5 bg-white">
        <div class="container w-full mt-5" style="padding-top: 20px">
            @if(isset($product) && count($product)>0)
                <div class="heading bora-4">
                    <form action="{{route('Client.orders.createRate')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="row mb-3">
                                <div class="row d-flex" style="height: 250px">
                                    <div class="col-2 mb-3 me-2">
                                        <a href="{{route('Client.product.detail',$product[0]->product_name)}}"><img class="me-3" src="{{asset('storage/'.$product[0]->product_image)}}" alt="" style=" width:100%;height:60%;border-radius:10px;"/></a>
                                    </div>
                                    <div class="col-9 mb-3">
                                        <p class="fs-5 fw-bold">{{$product[0]->product_name}} x {{$product[0]->quantity}} </p>
                                        @if($product[0]->size != null || $product[0]->color != null)
                                            <p class="fw-bold">{{$product[0]->size. '  '. $product[0]->color}} </p>
                                        @endif
                                        <div class="product[0]s-center gap-2 duration-300 relative z-[1]">
                                            <div class="text-title" style="margin-left: 10px">
                                                @if ($product[0]->sale_price > 0)
                                                    {{number_format($product[0]->sale_price, 0, ',', '.') . ' VNĐ';}} <br>
                                                @else
                                                    {{number_format($product[0]->price, 0, ',', '.') . ' VNĐ';}} <br>
                                                @endif
                                            </div>
                                            <div class="product-origin-price caption1 text-secondary2" style="margin-left: 10px"><del>
                                                @if ($product[0]->sale_price > 0)
                                                    {{number_format($product[0]->price, 0, ',', '.') . 'VNĐ';}}
                                                @endif
                                                </del>
                                            </div>
                                        <p class="fs-5 fw-bold">Tổng Tiền :
                                            @if ($product[0]->sale_price > 0)
                                                {{number_format($product[0]->sale_price * $product[0]->quantity, 0, ',', '.') . ' VNĐ';}} <br>
                                            @else
                                                {{number_format($product[0]->price * $product[0]->quantity, 0, ',', '.') . ' VNĐ';}} <br>
                                            @endif
                                        </p>
                                        </div>
            
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Ảnh</label>
                                            <input class="form-control" type="file" name="image[]" id="image"  multiple style="background-color: #dadada">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Đánh Giá Của Bạn</label>
                                            <input type="text" class="form-control" placeholder="Đánh giá của bạn về sản phẩm" name="content" value={{old('content')}}>
                                            @error('content')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <h1 class="text-center fs-5 fw-bold mb-2">Đánh Giá</h1>
                                        <section class='rating-widget'>
                                        <!-- Rating Stars Box -->
                                        <div class='rating-stars text-center'>
                                        <ul id='stars'>
                                            <li class='star' title='Poor' data-value='1'>
                                            <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Fair' data-value='2'>
                                            <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Good' data-value='3'>
                                            <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='Excellent' data-value='4'>
                                            <i class='fa fa-star fa-fw'></i>
                                            </li>
                                            <li class='star' title='WOW!!!' data-value='5'>
                                            <i class='fa fa-star fa-fw'></i>
                                            </li>
                                        </ul>
                                        </div>
                                        </section>
                                        @error('number_stars')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="number_stars" class='text-message'>
                        <button type="submit" class="btn btn-dark bg-dark text-light text-center mb-3" width="50px">Gửi</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            /* 1. Visualizing things on Hover - See next part for action on click */
            $('#stars li').on('mouseover', function() {
                var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on

                // Now highlight all the stars that's not after the current hovered star
                $(this).parent().children('li.star').each(function(e) {
                    if (e < onStar) {
                        $(this).addClass('hover');
                    } else {
                        $(this).removeClass('hover');
                    }
                });

            }).on('mouseout', function() {
                $(this).parent().children('li.star').each(function(e) {
                    $(this).removeClass('hover');
                });
            });


            /* 2. Action to perform on click */
            $('#stars li').on('click', function() {
                var onStar = parseInt($(this).data('value'), 10); // The star currently selected
                var stars = $(this).parent().children('li.star');

                for (i = 0; i < stars.length; i++) {
                    $(stars[i]).removeClass('selected');
                }

                for (i = 0; i < onStar; i++) {
                    $(stars[i]).addClass('selected');
                }

                // JUST RESPONSE (Not needed)
                var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
                $(document).ready(function() {
                    $("input[name='number_stars']").val(function() {
                        return ratingValue;
                    });
                });
                var msg = "";
                if (ratingValue > 1) {
                    msg = "Thanks! You rated this " + ratingValue + " stars.";

                } else {
                    msg = "We will improve ourselves. You rated this " + ratingValue + " stars.";
                }
                responseMessage(msg);

            });


        });


        function responseMessage(msg) {
            $('.success-box').fadeIn(200);
            $('.success-box div.text-message').html("<span>" + msg + "</span>");
        }
        $.ajax({

        })
    </script>
@endsection
