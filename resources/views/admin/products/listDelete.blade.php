@extends('admin.master')

@section('title', 'danh sách sản phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Sản phẩm </h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Trang chủ </a></li>
                <li class="breadcrumb-item">Danh sách </li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-lg-12 mt-3">
        <div class="card stretch stretch-full">
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <table id="example" class="table table-hover mb-0" >
                            <thead>
                                <tr>
                                    <th>Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Trạng Thái</th>
                                    <th class="text-end">Hành động </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>
                                            <div class="hstack gap-3">
                                                <div class="avatar-image avatar-lg rounded">
                                                    <img width="100%" class="img-fluid"
                                                        src="{{ asset('storage/' . $product->product_image) }}"
                                                        alt="Image">
                                                </div>

                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <a href="{{ route('Administration.products.show', $product->product_slug) }}"
                                                    class="d-block">{{ $product->product_name }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            @if(isset($product->minPrice) && !empty($product->minPrice) && $product->minPrice < $product->maxPrice)
                                                <span class="fw-bold text-danger">{{number_format($product->minPrice, 0, ',', '.') . ' VNĐ';}} - {{number_format($product->maxPrice, 0, ',', '.') . ' VNĐ';}}</span>
                                            @else
                                                <span class="fw-bold text-danger">{{number_format($product->maxPrice, 0, ',', '.') . ' VNĐ';}}</span>
                                            @endif
                                        </td>
                                       
                                        {{-- <td>
                                            <a href="javascript:void(0);"
                                                class="d-block mb-1">{{ $product->product_image }}</a>
                                        </td> --}}
                                        <td>
                                            <a href="javascript:void(0);" class="d-block mb-1">
                                                @if ($product->status == 1)
                                                <span class="badge bg-soft-success text-success">Hoạt Động</span>
                                                @elseif ($product->status == 2)
                                                <span class="badge bg-soft-danger text-danger">Không Hoạt Động</span>
                                                @endif
                                            </a>
                                        </td>
                                        <td class="text-end">
                                            <div class="hstack gap-2 justify-content-end">
                                                <form action="{{ route('Administration.products.restore') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" value="{{ $product->product_id }}" name="product_id" id="">
                                                    <button class="btn btn-success me-2" type="submit">Khôi Phục</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection
