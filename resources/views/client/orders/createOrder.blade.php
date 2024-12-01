@extends('client.master')

@section('title',"Đặt Hàng")

@section('content')
<script src="https://esgoo.net/scripts/jquery.js"></script>

<div class="row mt-5 mb-5" >
    <p class="text-center fs-3 fw-bold">ĐẶT HÀNG</p>
</div>

<div class="checkout-block relative mt-3 bg-surface">
    <form action="{{route('Client.orders.store')}}" method="post">
        @csrf
        <div class="content-main flex max-lg:flex-col-reverse justify-between">
            <div class="left flex lg:justify-end w-full mt-2">
                <div class="lg:max-w-[716px] flex-shrink-0 w-full lg:pr-[70px] pl-[16px] max-lg:pr-[16px]">
                        <div class="information">
                            <div class="heading5">Thông Tin Nhận Hàng</div>
                            <div class="form-checkout mt-2">
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Họ Và Tên</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"  name="fullname" 
                                    @if(isset($_SESSION['dataInfo']))
                                        value="{{$_SESSION['dataInfo']['fullname']}}"
                                    @else
                                        value="{{old('fullname')}}"
                                    @endif
                                    >
                                    @error('fullname')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Email </label>
                                    <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="name@example.com"
                                    @if(isset($_SESSION['dataInfo']))
                                        value="{{$_SESSION['dataInfo']['email']}}"
                                    @else
                                        value="{{old('email')}}"
                                    @endif
                                    >
                                     @error('email')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Số Điện Thoại</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="phone" 
                                    @if(isset($_SESSION['dataInfo']))
                                        value="{{$_SESSION['dataInfo']['phone']}}"
                                    @else
                                        value="{{old('phone')}}"
                                    @endif
                                    >
                                     @error('phone')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3" >
                                    <label for="exampleFormControlInput1" class="form-label">Tỉnh Thành</label>
                                    <select class="form-control" id="tinh"  title="Chọn Tỉnh Thành" >
                                        <option value="0">Tỉnh Thành</option>
                                    </select> 
                                     @error('province')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3" >
                                    <label for="exampleFormControlInput1" class="form-label">Quận Huyện</label>
                                    <select class="form-control" id="quan"  title="Chọn Quận Huyện" >
                                        <option value="0">Quận Huyện</option>
                                    </select>
                                     @error('district')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3" > 
                                    <label for="exampleFormControlInput1" class="form-label">Phường Xã</label>
                                    <select class="form-control" id="phuong"  title="Chọn Phường Xã" >
                                        <option value="0">Phường Xã</option>
                                    </select>
                                     @error('ward')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Đường</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="street"
                                    @if(isset($_SESSION['dataInfo']))
                                        value="{{$_SESSION['dataInfo']['street']}}"
                                    @else
                                        value="{{old('street')}}"
                                    @endif
                                    >
                                     @error('street')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <input type="hidden" name="province" id="city"/>
                                <input type="hidden" name="district" id="district"/>
                                <input type="hidden" name="ward" id="ward"/>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Địa Chi Cụ Thể</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="address"placeholder="Số nhà - đường - thôn/tổ dân phố" 
                                    @if(isset($_SESSION['dataInfo']))
                                        value="{{$_SESSION['dataInfo']['address']}}"
                                    @else
                                        value="{{old('address')}}"
                                    @endif
                                    >
                                     @error('address')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleFormControlInput1" class="form-label">Note</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="note" 
                                    @if(isset($_SESSION['dataInfo']['note']))
                                        value="{{$_SESSION['dataInfo']['note']}}"
                                    @else
                                        value="{{old('note')}}"
                                    @endif
                                    >
                                     @error('note')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="heading5">Phương Thức Thanh Toán</div>
                            <div class="deli_type mt-2">
                                <div class="item flex items-center gap-2 relative px-5 border border-line rounded-t-lg">
                                    <input type="radio" id="ship_type" class="cursor-pointer" name="method_payment"
                                        checked="" value="COD" @checked(old('method_payment') == "COD")><label for="ship_type"
                                        class="w-full py-4 cursor-pointer">Thanh Toán khi Nhận Hàng</label><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                        viewBox="0 0 256 256" class="text-xl absolute top-1/2 right-5 -translate-y-1/2">
                                        <path
                                            d="M247.42,117l-14-35A15.93,15.93,0,0,0,218.58,72H184V64a8,8,0,0,0-8-8H24A16,16,0,0,0,8,72V184a16,16,0,0,0,16,16H41a32,32,0,0,0,62,0h50a32,32,0,0,0,62,0h17a16,16,0,0,0,16-16V120A7.94,7.94,0,0,0,247.42,117ZM184,88h34.58l9.6,24H184ZM24,72H168v64H24ZM72,208a16,16,0,1,1,16-16A16,16,0,0,1,72,208Zm81-24H103a32,32,0,0,0-62,0H24V152H168v12.31A32.11,32.11,0,0,0,153,184Zm31,24a16,16,0,1,1,16-16A16,16,0,0,1,184,208Zm48-24H215a32.06,32.06,0,0,0-31-24V128h48Z">
                                        </path>
                                    </svg></div>
                                <div class="item flex items-center gap-2 relative px-5 border border-line rounded-b-lg">
                                    <input type="radio" id="store_type" class="cursor-pointer" name="method_payment" value="banking"/><label
                                        for="store_type" class="w-full py-4 cursor-pointer"  @checked(old('method_payment') == "banking") >Thanh Toán Online</label><svg
                                        xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                        viewBox="0 0 256 256" class="text-xl absolute top-1/2 right-5 -translate-y-1/2">
                                        <path
                                            d="M232,96a7.89,7.89,0,0,0-.3-2.2L217.35,43.6A16.07,16.07,0,0,0,202,32H54A16.07,16.07,0,0,0,38.65,43.6L24.31,93.8A7.89,7.89,0,0,0,24,96v16a40,40,0,0,0,16,32v64a16,16,0,0,0,16,16H200a16,16,0,0,0,16-16V144a40,40,0,0,0,16-32ZM54,48H202l11.42,40H42.61Zm50,56h48v8a24,24,0,0,1-48,0Zm-16,0v8a24,24,0,0,1-48,0v-8ZM200,208H56V151.2a40.57,40.57,0,0,0,8,.8,40,40,0,0,0,32-16,40,40,0,0,0,64,0,40,40,0,0,0,32,16,40.57,40.57,0,0,0,8-.8Zm-8-72a24,24,0,0,1-24-24v-8h48v8A24,24,0,0,1,192,136Z">
                                        </path>
                                    </svg></div>
                            </div>
                            @error('method_payment')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                        </div>
                </div>
            </div>
            <div class="right justify-start flex-shrink-0 lg:w-[47%] bg-surface lg:py-20 py-12">
                <div
                    class="lg:sticky lg:top-24 h-fit lg:max-w-[606px] w-full flex-shrink-0 lg:pl-[80px] pr-[16px] max-lg:pl-[16px]">
                    <div class="list_prd flex flex-col gap-7">
                        @if(isset($data) && !empty($data) && isset($data1) && !empty($data1))
                        @php
                            $_SESSION['Total'] = 0;
                            $_SESSION['ship'] = 30000;
                            foreach ($data1['Cart'] as $item1 ):
                                foreach ($data as $item):
                        @endphp
                            
                            @if ($item == $item1->cart_detail_id)
                            <input type="hidden" name="cart_detail_id[]" value="{{$item1->cart_detail_id}}">
                            <div class="item flex items-center justify-between gap-6">
                                <div class="flex items-center gap-6">
                                    <div class="bg_img relative flex-shrink-0 w-[100px] h-[100px]">
                                        <img
                                            src="{{asset('storage/'.$item1->product_image)}}" alt="product/fashion/10-1"
                                            class="w-full h-full object-cover rounded-lg" /><span
                                            class="quantity flex items-center justify-center absolute -top-3 -right-3 w-7 h-7 rounded-full bg-black text-white">{{$item1->quantity}}</span>
                                    </div>
                                    <div><strong class="name text-title">{{$item1->product_name}}</strong>
                                        <div class="flex items-center gap-2 mt-2"><svg xmlns="http://www.w3.org/2000/svg"
                                                width="1em" height="1em" fill="currentColor" viewBox="0 0 256 256"
                                                class="text-secondary">
                                                <path
                                                    d="M243.31,136,144,36.69A15.86,15.86,0,0,0,132.69,32H40a8,8,0,0,0-8,8v92.69A15.86,15.86,0,0,0,36.69,144L136,243.31a16,16,0,0,0,22.63,0l84.68-84.68a16,16,0,0,0,0-22.63Zm-96,96L48,132.69V48h84.69L232,147.31ZM96,84A12,12,0,1,1,84,72,12,12,0,0,1,96,84Z">
                                                </path>
                                            </svg><span class="discount">{{number_format($item1->price - $item1->sale_price, 0, ',', '.') . ' VNĐ';}}</span></span></div>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-1">
                                    @if(isset($item1->sale_price) && $item1->sale_price<$item1->price)
                                    <del class="caption1 text-secondary text-end org_price">{{number_format($item1->price, 0, ',', '.') . ' VNĐ';}}</del>
                                    <strong class="text-title price" >{{number_format($item1->sale_price, 0, ',', '.') . ' VNĐ';}}</strong>
                                    @else
                                        <strong class="text-title price" >{{number_format($item1->price, 0, ',', '.') . ' VNĐ';}}</strong>
                                    @endif
                                </div>
                                <div class="">
                                    <strong class="text-title price fw-bold">{{number_format($item1->total, 0, ',', '.') . ' VNĐ';}}</strong>
                                </div>
                            </div>
                        @php
                            $_SESSION['Total'] += $item1->total;
                            endif;
                                
                                endforeach;
                            endforeach;
                        @endphp
                        <div class="form_discount flex gap-3 mt-8">
                                <input type="text" placeholder="Discount code" class="w-full border border-line rounded-lg px-4" name="voucher_code"/>
                                <button class="flex-shrink-0 button-main bg-black text-light" type="submit" name="voucher" value="voucher">Áp Dụng</button>
                        </div>
                        <div class="row">
                            @if (session('error'))
                                <span class="text-danger">{{session('error')}}</span>
                            @endif
                        </div>
                        <div class="row flex gap-3 " style="margin-left: 10px;">
                            @if (isset($voucher) && !empty($voucher))
                                @foreach ( $voucher as $item )
                                <div class="card col-5 me-1  ">
                                    <p class="fw-bold">Mã :{{$item->voucher_code}}</p>
                                    <span>Giá Trị : {{$item->type == 0 ? $item->value."%" : number_format($item->value, 0, ',', '.') . ' VNĐ';}}</span>
                                </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="subtotal flex items-center justify-between mt-2"><strong
                                class="heading6">Thành Tiền</strong><strong class="heading6">{{number_format($_SESSION['Total'], 0, ',', '.') . ' VNĐ';}}</strong></div>
                        <div class="ship-block flex items-center justify-between mt-2"><strong
                                class="heading6">Phí Ship</strong><span class="body1 text-secondary">{{number_format($_SESSION['ship'], 0, ',', '.') . ' VNĐ';}}</span></div>
                            <input type="hidden" name="total" value={{$_SESSION['Total'] + $_SESSION['ship']}}>
                        @if(isset($_SESSION['voucher']))
                            <div class="ship-block flex items-center justify-between mt-2"><strong
                                class="heading6">Tiền Được Giảm</strong><span class="body1 text-secondary">
                                    @if ($_SESSION['voucher'][0]->type ==0)
                                    {{number_format(round(($_SESSION['Total'] + $_SESSION['ship'])/100 * $_SESSION['voucher'][0]->value), 0, ',', '.') . ' VNĐ';}}
                                    @else
                                    {{number_format(($_SESSION['Total'] + $_SESSION['ship']) -$_SESSION['voucher'][0]->value, 0, ',', '.') . ' VNĐ';}}
                                    @endif</span>
                            </div>
                        @endif
                        <div class="total-cart-block flex items-center justify-between mt-2"><strong
                                class="heading6">Tổng Giá Trị Đơn Hàng</strong>
                            <div class="flex items-end gap-2"><strong
                                    class="heading4"> 
                                    @if(isset($_SESSION['voucher']))
                                        @if ($_SESSION['voucher'][0]->type ==0)
                                        {{number_format(($_SESSION['Total'] + $_SESSION['ship']) - round(($_SESSION['Total'] + $_SESSION['ship'])/100 * $_SESSION['voucher'][0]->value), 0, ',', '.') . ' VNĐ';}}
                                        <input type="hidden" name="total_discount" value={{($_SESSION['Total'] + $_SESSION['ship']) - round(($_SESSION['Total'] + $_SESSION['ship'])/100 * $_SESSION['voucher'][0]->value)}}>
                                        @else
                                        @if($_SESSION['voucher'][0]->value > $_SESSION['Total'] + $_SESSION['ship'] )
                                            0.VNĐ
                                            <input type="hidden" name="total_discount" value='0'>
                                            @else
                                            {{number_format((($_SESSION['Total'] + $_SESSION['ship']) - $_SESSION['voucher'][0]->value), 0, ',', '.') . ' VNĐ';}}
                                            <input type="hidden" name="total_discount" value={{($_SESSION['Total'] + $_SESSION['ship']) - $_SESSION['voucher'][0]->value}}>
                                            @endif
                                        @endif
                                    @else
                                        {{number_format(($_SESSION['Total'] + $_SESSION['ship']), 0, ',', '.') . ' VNĐ';}}
                                        <input type="hidden" name="total_discount" value={{($_SESSION['Total'] + $_SESSION['ship'])}}>
                                    @endif</strong></div>
                        </div>
                        <div class="row">
                            <button class="btn btn-dark bg-dark text-light" type="submit" name="order" value="order">Đặt Hàng</button>
                        </div>
                                
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </form>
</div>
<script>

    const selectElement = document.getElementById('tinh');
    const inputElement = document.getElementById('city');
    const selectElement1 = document.getElementById('quan');
    const inputElement1 = document.getElementById('district');
    const selectElement2 = document.getElementById('phuong');
    const inputElement2 = document.getElementById('ward');

    selectElement.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        inputElement.value = selectedOption.text;
        console.log(inputElement.value)
		});
    selectElement1.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        inputElement1.value = selectedOption.text;
        console.log(inputElement1.value)
    });
    selectElement2.addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        inputElement2.value = selectedOption.text;
        console.log(inputElement2.value)
    });


    $(document).ready(function() {
        //Lấy tỉnh thành
        $.getJSON('https://esgoo.net/api-tinhthanh/1/0.htm',function(data_tinh){	       
            if(data_tinh.error==0){
               $.each(data_tinh.data, function (key_tinh,val_tinh) {
                  $("#tinh").append('<option value="'+val_tinh.id+'">'+val_tinh.full_name+'</option>');
               });
               $("#tinh").change(function(e){
                    var idtinh=$(this).val();
                    //Lấy quận huyện
                    $.getJSON('https://esgoo.net/api-tinhthanh/2/'+idtinh+'.htm',function(data_quan){	       
                        if(data_quan.error==0){
                           $("#quan").html('<option value="0">Quận Huyện</option>');  
                           $("#phuong").html('<option value="0">Phường Xã</option>');   
                           $.each(data_quan.data, function (key_quan,val_quan) {
                              $("#quan").append('<option value="'+val_quan.id+'">'+val_quan.full_name+'</option>');
                           });
                           //Lấy phường xã  
                           $("#quan").change(function(e){
                                var idquan=$(this).val();
                                $.getJSON('https://esgoo.net/api-tinhthanh/3/'+idquan+'.htm',function(data_phuong){	       
                                    if(data_phuong.error==0){
                                       $("#phuong").html('<option value="0">Phường Xã</option>');   
                                       $.each(data_phuong.data, function (key_phuong,val_phuong) {
                                          $("#phuong").append('<option value="'+val_phuong.id+'">'+val_phuong.full_name+'</option>');
                                       });
                                    }
                                });
                           });
                            
                        }
                    });
               });   
                
            }
        });
     });	    
 </script>
@endsection
