@extends('admin.master')

@section('title', 'trang chủ')

@section('content')
<div class="row ">
    <div class="col-xxl-3 col-md-6 mt-3" >
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-4">
                    <div class="d-flex gap-4 align-items-center">
                        <div class="avatar-text avatar-lg bg-gray-200">
                            <i class="feather-dollar-sign"></i>
                        </div>
                        <div>
                            <h3 class="fs-13 fw-semibold text-truncate-1-line">Sản Phẩm</h3>
                            <div class="fs-4 fw-bold text-dark"><span class="counter">{{$product}}</span></div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="">
                        <i class="feather-more-vertical"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- [Invoices Awaiting Payment] end -->
    <!-- [Converted Leads] start -->
    <div class="col-xxl-3 col-md-6 mt-3" >
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-4">
                    <div class="d-flex gap-4 align-items-center">
                        <div class="avatar-text avatar-lg bg-gray-200">
                            <i class="feather-cast"></i>
                        </div>
                        <div>
                            <h3 class="fs-13 fw-semibold text-truncate-1-line">Khách Hàng</h3>
                            <div class="fs-4 fw-bold text-dark"><span class="counter">{{$user}}</span></div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="">
                        <i class="feather-more-vertical"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- [Converted Leads] end -->
    <!-- [Projects In Progress] start -->
    <div class="col-xxl-3 col-md-6 mt-3" >
        <div class="card stretch stretch-full">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-4">
                    <div class="d-flex gap-4 align-items-center">
                        <div class="avatar-text avatar-lg bg-gray-200">
                            <i class="feather-briefcase"></i>
                        </div>
                        <div>
                            <h3 class="fs-13 fw-semibold text-truncate-1-line">Đơn Hàng</h3>
                            <div class="fs-4 fw-bold text-dark"><span class="counter">{{$order}}</span></div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="">
                        <i class="feather-more-vertical"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- [Projects In Progress] end -->
    <!-- [Conversion Rate] start -->
    <div class="col-xxl-3 col-md-6 mt-3" >
    <div class="card stretch stretch-full">
        <div class="card-body">
            <div class="d-flex align-items-start justify-content-between mb-4">
                <div class="d-flex gap-4 align-items-center">
                    <div class="avatar-text avatar-lg bg-gray-200">
                        <i class="feather-activity"></i>
                    </div>
                    <div>
                        <h3 class="fs-13 fw-semibold text-truncate-1-line">Bài Viết</h3>
                        <div class="fs-4 fw-bold text-dark"><span class="counter">{{$post}}</span></div>
                    </div>
                </div>
                <a href="javascript:void(0);" class="">
                    <i class="feather-more-vertical"></i>
                </a>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="myInput" value="{{$json_array}}">
<input type="hidden" id="myInput1" value="{{$json_array1}}">
<input type="hidden" id="myInput2" value="{{$json_array2}}">
<div class="col-xxl-12" style="padding: 10px">
    <div class="card stretch stretch-full">
        <div class="card-header">
            <h5 class="card-title">Doanh Thu Trong Năm</h5>
        </div>
        <div class="card-body custom-card-action p-0">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xxl-8 col-md-8">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Sản Phẩm Bán Chạy</h5>
            </div>
            <div class="card-body custom-card-action">
                <div class="row g-4">
                    <div class="table-responsive" style="padding: 20px;">
                        <table  class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng bán</th>
                                    <th class="text-end">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                 $i=1;
                                foreach ($productHot as $value ):
                                @endphp
                                     <tr>
                                        <td>
                                            <span  class="d-block mb-1">{{$i}}</span>
                                        </td>
                                        <td>
                                            <span  class="d-block mb-1"><img src="{{asset('storage/'.$value->product_image)}}" alt="" width="100px"></span>
                                        </td>
                                        <td>
                                            <span  class="d-block mb-1">{!! substr($value->product_name, 0, 20) . '...' !!}</span>
                                        </td>
                                        <td>
                                            <span  class="d-block mb-1 text-danger fw-bold">
                                                @if($value->minPrice > 0){{number_format($value->minPrice, 0, ',', '.') . 'VNĐ';}} - @endif {{number_format($value->maxPrice, 0, ',', '.') . 'VNĐ';}}
                                            </span>
                                        </td>
                                        <td>
                                            <span  class="d-block mb-1">{{$value->quantityProduct}}</span>
                                        </td>
                                        <td class="text-end">
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{route('Administration.products.show', $value->product_slug)}}" class="avatar-text avatar-md">
                                                    <i class="feather-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @php
                                $i++;
                                endforeach
                                @endphp
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4 card stretch stretch-full">
        <div class="card-header">
            <h5 class="card-title">Thống Kê Sản Phẩm Theo Danh Mục</h5>
        </div>
        <div class="card-body custom-card-action p-0">
            <div>
                <canvas id="myChart1"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xxl-8 col-md-8">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Sản Phẩm Mới</h5>
            </div>
            <div class="card-body custom-card-action">
                <div class="row g-4">
                    <div class="table-responsive" style="padding: 20px;">
                        <table  class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th class="text-end">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                 $i=1;
                                foreach ($productNew as $value ):
                                @endphp
                                     <tr>
                                        <td>
                                            <span  class="d-block mb-1">{{$i}}</span>
                                        </td>
                                        <td>
                                            <span  class="d-block mb-1"><img src="{{asset('storage/'.$value->product_image)}}" alt="" width="100px"></span>
                                        </td>
                                        <td>
                                            <span  class="d-block mb-1">{!! substr($value->product_name, 0, 20) . '...' !!}</span>
                                        </td>
                                        <td>
                                            <span  class="d-block mb-1 text-danger fw-bold">
                                                @if($value->minPrice > 0){{number_format($value->minPrice, 0, ',', '.') . 'VNĐ';}} - @endif {{number_format($value->maxPrice, 0, ',', '.') . 'VNĐ';}}
                                            </span>
                                        </td>
                                        <td class="text-end">
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{route('Administration.products.show', $value->product_slug)}}" class="avatar-text avatar-md">
                                                    <i class="feather-eye"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @php
                                $i++;
                                endforeach
                                @endphp
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xxl-4 col-md-4">
        <div class="card stretch stretch-full">
            <div class="card-header">
                <h5 class="card-title">Thông Kê Số Lượng Trạng Thái Đơn Hàng</h5>
            </div>
            <div class="card-body custom-card-action">
                <div class="row g-4">
                    <div class="col-sm-6">
                        <div class="px-4 py-3 text-center border border-dashed rounded-3">
                            <h2 class="fs-13 tx-spacing-1">Đơn Chờ Xác Nhận</h2>
                            <div class="fs-11 text-muted text-truncate-1-line">{{$orderUnconfirm}}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="px-4 py-3 text-center border border-dashed rounded-3">
                            <h2 class="fs-13 tx-spacing-1">Đơn Đã Xác Nhận</h2>
                            <div class="fs-11 text-muted text-truncate-1-line">{{$orderConfirm}}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="px-4 py-3 text-center border border-dashed rounded-3">
                            <h2 class="fs-13 tx-spacing-1">Đơn Đang Giao </h2>
                            <div class="fs-11 text-muted text-truncate-1-line">{{$orderShip}}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="px-4 py-3 text-center border border-dashed rounded-3">
                            <h2 class="fs-13 tx-spacing-1">Đơn Đã Giao Đến Khách Hàng</h2>
                            <div class="fs-11 text-muted text-truncate-1-line">{{$orderDelivered}}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="px-4 py-3 text-center border border-dashed rounded-3">
                            <h2 class="fs-13 tx-spacing-1">Đơn Hoàn Thành</h2>
                            <div class="fs-11 text-muted text-truncate-1-line">{{$orderReceived}}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="px-4 py-3 text-center border border-dashed rounded-3">
                            <h2 class="fs-13 tx-spacing-1">Đơn Hoàn Trả</h2>
                            <div class="fs-11 text-muted text-truncate-1-line">{{$orderReturn}}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="px-4 py-3 text-center border border-dashed rounded-3">
                            <h2 class="fs-13 tx-spacing-1">Đơn Bị Hủy</h2>
                            <div class="fs-11 text-muted text-truncate-1-line">{{$orderCancel}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{route('Administration.orders.list')}}" class="btn btn-primary">Danh Sách Đơn Hàng</a>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    const myInput = document.getElementById('myInput');
    const myInput1 = document.getElementById('myInput1');
    const myInput2 = document.getElementById('myInput2');
    const myArray = JSON.parse(myInput.value);
    const myArray1 = JSON.parse(myInput1.value);
    const myArray2 = JSON.parse(myInput2.value);
    const chart   = Object.values(myArray)
    const chart1   = Object.values(myArray1)
    const chart2   = Object.values(myArray2)
    console.log(chart); // Output: ["apple", "banana", "orange"]
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('myChart');
    const ctx1 = document.getElementById('myChart1');
    const data = {
        labels: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12'],
        datasets: [{
            label: "Doanh Thu",
            data: chart,
            backgroundColor: [
            'rgb(255, 99, 132, 0.4)',
            'rgb(255, 159, 64, 0.4)',
            'rgb(255, 205, 86, 0.4)',
            'rgb(75, 192, 192, 0.4)',
            'rgb(54, 162, 235, 0.4)',
            'rgb(153, 102, 255, 0.4)',
            'rgb(201, 203, 207, 0.4)',
            'rgb(255, 228, 181, 0.4)	',
            'rgb(139, 134, 130 0.4)',
            'rgb(0, 0, 139, 0.4)',
            'rgb(139, 58, 58,0.4)',
            'rgb(139 ,26 ,26, 0.4)',

            ],
            borderColor: [
            'rgb(255, 99, 132, 0.4)',
            'rgb(255, 159, 64, 0.4)',
            'rgb(255, 205, 86, 0.4)',
            'rgb(75, 192, 192, 0.4)',
            'rgb(54, 162, 235, 0.4)',
            'rgb(153, 102, 255, 0.4)',
            'rgb(201, 203, 207, 0.4)',
            'rgb(255, 228, 181, 0.4)	',
            'rgb(139, 134, 130, 0.4)',
            'rgb(0, 0, 139, 0.4)',
            'rgb(139, 58, 58, 0.4)',
            'rgb(139 ,26 ,26, 0.4)',
            ],
            borderWidth: 1
        }]
        };
    new Chart(ctx, {
      type: 'bar',
      data: data,
      
    });
  </script>
  <script>
    const data1 = {
        labels: chart1,
        datasets: [{
            label: 'Thông Kê Sản Phẩm Theo Danh Mục',
            data: chart2,
            backgroundColor: [
           'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)',
            'rgb(255, 228, 181)',
            'rgb(139, 134, 130)',
            'rgb(0, 0, 139)',
            'rgb(139, 58, 58)',
            'rgb(139 ,26 ,26)',
            ],
            hoverOffset: 4
        }]
        };
    new Chart(ctx1, {
      type: 'doughnut',
      data: data1,
    });
    // const config = {
    //     type: 'doughnut',
    //     data: data1,
    //     };
  </script>
@endsection
