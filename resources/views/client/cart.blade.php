@extends('client.master')

@section('title')

@section('content')

<div class="fs-3 fw-bold text-center mb-3 mt-5">
    GIỎ HÀNG
</div>
<div class="cart-block md:py-10 py-10" style="background-color:white">
    <div class="container mt-3">
        <div class="content-main flex justify-between max-xl:flex-col gap-y-8">
            <div class="xl:w-2/3 xl:pr-3 w-full">
                @if(isset($cart['Cart']) && !empty($cart['Cart']))
                <div class="heading bora-4"  style="border:2px solid black; border-radius:20px; padding:20px;">
                    <form action="{{route('Client.cart.destroy')}}" method="post">
                        @csrf
                        @method('DELETE')
                        <table class="table">
                            <thead class="bg-drak text-light">
                                <tr>
                                <th scope="col"></th>
                                <th scope="col">Sản Phẩm</th>
                                <th scope="col"></th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Tổng Giá</th>
                                </tr>
                            </thead>
                            <tbody id ="product-list">
                                @foreach($cart['Cart'] as $item)
                                <tr>
                                    <th scope="row"><input type="checkbox" name="cart_variant_id[]" id ="cart_variant_id{{$item->cart_detail_id}}" value="{{$item->cart_detail_id}}" data-price={{$item->total}} ></th>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{route('Client.product.detail',$item->product_slug)}}"><img class="me-3" src="{{asset('storage/'.$item->product_image)}}" alt="" width="100"/></a>
                                            <div class="text-title">{{$item->product_name}}</div>
                                        </div>
                                    </td>
                                    <td>
                                        {{$item->size ."  ".  $item->color}}
                                    </td>
                                    <td >
                                        <div class="input-group mb-3 text-center" style="width: 140px;">
                                            <button class="btn btn-outline-secondary" type="button" id="decrement">-</button>
                                            <input type="text" min ="1" id="{{"quantity_".$item->cart_detail_id}}" class="form-control text-center" value="{{$item->quantity}}" aria-label="Recipient's username" aria-describedby="button-addon2" disabled>
                                            <span class="{{"quantity_".$item->cart_detail_id}}" hidden>{{$item->Instock}}</span>
                                            <button class="btn btn-outline-secondary" id="increment" type="button">+</button>
                                        </div>
                                        <span class="text-danger text-sm">Số Lượng Còn: {{$item->Instock}}</span>
                                    </td>
                                    <td>
                                        <div class="items-center gap-2 duration-300 relative z-[1]">
                                            <div class="text-title" >
                                                @if ($item->sale_price > 0)
                                                    {{number_format($item->sale_price, 0, ',', '.') . ' VNĐ';}} <br>
                                                @else
                                                    {{number_format($item->price, 0, ',', '.') . ' VNĐ';}} <br>
                                                @endif
                                            </div>
                                            <div class="product-origin-price caption1 text-secondary2"><del>
                                                @if ($item->sale_price > 0)
                                                    {{number_format($item->price, 0, ',', '.') . 'VNĐ';}}
                                                @endif
                                                </del>
                                            </div>
                                            <div class="text-title" id="price_{{$item->cart_detail_id}}" hidden>
                                                @if ($item->sale_price > 0)
                                                    {{$item->sale_price}} <br>
                                                @else
                                                    {{$item->price}} <br>
                                                @endif
                                            </div> 
                                        </div>
                                    </td>
                                    <td> <div class="text-title" id="total_{{$item->cart_detail_id}}">{{number_format($item->total, 0, ',', '.') . ' VNĐ';}}</div></td>
                                </tr>
                                @endforeach
                            </tbody>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        </table>
                        <button  class="btn btn-dark"  type="submit" style="background-color: black">Xóa Sản Phẩm</button>
                    </form>
                </div>
                @else
                    <div class="list-product-main w-full mt-3">
                        <p class="text-button pt-3">No product in cart</p>
                    </div>
                @endif
            </div>
            <div class="xl:w-1/3 xl:pl-12 w-full" >
                <div class="checkout-block bg-surface p-6 rounded-2xl "  style="border:2px solid black">
                    <div class="heading6">Đơn Hàng</div>
                    <div class="total-cart-block pt-4 pb-4 flex justify-between">
                        <div class="text-title">Tổng Tiền </div>
                        <div class=" items-center gap-2  mt-1 duration-300 relative z-[1]">
                            <div class="text-title" id="totalPrice">
                                0 VND
                            </div>
                        </div>
                    </div>
                    <div class="block-button flex flex-col items-center gap-y-4 mt-5 ">
                        {{-- <form action="{{route('Client.orders.orderCart')}}" method="POST" id="checkout" onsubmit="return Checkout()">
                            @csrf  --}}
                            <input type="hidden" id="product" name="product[]">
                            <button class="checkout-btn button-main text-center w-full bg-black text-white" id ="order">Đặt Hàng</button>
                        {{-- </form> --}}
                        <a class="text-button hover-underline" href="{{route('Client.Home')}}">Tiếp tục mua sắm</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if (session('error'))
    <input type="hidden" id="error" value="{{session('error')}}">
@endif
<script>
    $('#order').click(function() {
        const product_id = $('#product').val();
            if(product_id == ""){
                swal({
                    icon: "error",
                    title: "Vui lòng chọn sản phẩm",
                    })
            }else{
                // const product_id1 = $('#product').val();
                $.ajax({
                    url: "{{route('Client.orders.orderCart1')}}", // Đường dẫn đến controller
                    type: 'POST',
                    data: {
                            _token : $('meta[name="csrf-token"]').attr('content'),
                            "product_id" : product_id,
                        },
                    success: function(response) {
                        window.location.href = "{{route('Client.orders.orderCart')}}";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        swal({
                        icon: "error",
                        title: jqXHR.responseJSON.data,
                        }.then(()=>{
                            if(jqXHR.responseJSON.route != ""){
                                window.location.href = "{{route('Client.cart.list')}}";
                            }
                        }));
                    }
                });
            }
        console.log(product_id);
    })


    const error = document.getElementById('error');
    if(error){
        if(error.value !=""){
            swal({
                icon: "error",
                title: error.value,
            });
    }
    }
    // function Checkout() {
    //     const cart_detail_id = document.getElementById('product').value;
    //     if (cart_detail_id == "") {
    //         alert("Vui lòng chọn sản phẩm");
    //         return false; 
    //     }
    //     return true;
    // }
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const totalElement = document.getElementById('totalPrice');

    checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', () => {
        let total = 0;
        checkboxes.forEach(cb => {
        if (cb.checked) {
            total += parseInt(cb.dataset.price);
        }
        });
        totalElement.textContent = `${Intl.NumberFormat('vi').format(total)} VNĐ `;
    });
    });

    $('input[name="cart_variant_id[]"]').on('change', function() {
    // Lấy tất cả các checkbox đã được chọn
    var selectedValues = $('input[name="cart_variant_id[]"]:checked').map(function() {
        return $(this).val();
    }).get();

    // Chuyển mảng thành chuỗi (nếu cần)
    var selectedValuesString = selectedValues.join(', ');
    var value = selectedValuesString.split(",")
    // Gán giá trị cho input kết quả
    $('#product').val(value);
    console.log(document.getElementById('product').value);
    });



    function edit_data(cart_detail_id,updateQuantity,quantityElement,responseData,price,total) {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
            url: window.location.href,
            method: "POST",
            data: {
                cart_detail_id: cart_detail_id,
                quantity: updateQuantity,
            },
            dataType: "json",
            success: function(data) {
                // const totalPrice = (parseInt(price.innerHTML) *  quantityElement.value);
                // total.innerHTML =  `${Intl.NumberFormat('vi').format(totalPrice)} VNĐ `;
                // const productElement = document.getElementById(`cart_variant_id${cart_detail_id}`);
                // productElement.dataset.price = totalPrice;
            },
        })
    }
    const productList = document.getElementById('product-list');
    const incrementButtons = document.querySelectorAll('#increment');
    const decrementButtons = document.querySelectorAll('#decrement');
    incrementButtons.forEach(button => {
    button.addEventListener('click',   
        () => {
            
            // Lấy ID của phần tử span chứa số lượng tương ứng với nút được click
            const quantityId = button.parentElement.querySelector('input').id;
            console.log(quantityId);
            // // Lấy phần tử span đó
            const quantityElement = document.getElementById(quantityId);
            console.log(quantityElement.value);
            const quantityElement1 = document.querySelector(`span.${quantityId}`);
            const IdCart_detail = quantityId.split('_');
            const id =parseInt(IdCart_detail[1]) ;
            var responseData = true;
            var price = document.getElementById(`price_${id}`);
            var total = document.getElementById(`total_${id}`);
            // // // Tăng giá trị số lượng lên 1
            if(parseInt(quantityElement1.textContent) > quantityElement.value ){
                quantityElement.value = parseInt(quantityElement.value) + 1;
                var check = quantityElement.value;
                edit_data(id,check,quantityElement,responseData,price,total); 
                const totalPrice = (parseInt(price.innerHTML) *  quantityElement.value);
                total.innerHTML =  `${Intl.NumberFormat('vi').format(totalPrice)} VNĐ `;
                const productElement = document.getElementById(`cart_variant_id${id}`);
                productElement.dataset.price = totalPrice;

                const checkboxes = document.getElementsByName("cart_variant_id[]");
                checkboxes.forEach(checkbox => checkbox.checked = false);
                $('#product').val("");
                totalElement.innerHTML = "0 VNĐ"
            }
            
        });
    });
    decrementButtons.forEach(button => {
    button.addEventListener('click',   
        () => {
            
            // Lấy ID của phần tử span chứa số lượng tương ứng với nút được click
            const quantityId = button.parentElement.querySelector('input').id;
            // // Lấy phần tử span đó
            const quantityElement = document.getElementById(quantityId);
            const IdCart_detail = quantityId.split('_');
            const id =parseInt(IdCart_detail[1]) ;
            var price = document.getElementById(`price_${id}`);
            var total = document.getElementById(`total_${id}`);
            // // // Tăng giá trị số lượng lên 1
            var responseData = false;
            if(quantityElement.value > 1){
                quantityElement.value = parseInt(quantityElement.value) - 1;
                var check = quantityElement.value;
                edit_data(id,check,quantityElement,responseData,price,total); 
                const totalPrice = (parseInt(price.innerHTML) *  quantityElement.value);
                total.innerHTML =  `${Intl.NumberFormat('vi').format(totalPrice)} VNĐ `;
                const productElement = document.getElementById(`cart_variant_id${id}`);
                productElement.dataset.price = totalPrice;

                const checkboxes = document.getElementsByName("cart_variant_id[]");
                checkboxes.forEach(checkbox => checkbox.checked = false);
                $('#product').val("");
                totalElement.innerHTML = "0 VNĐ"
            }
        });
    });
</script>
@endsection