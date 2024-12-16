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
                    <a href="{{ route('Administration.products.create') }}" class=" btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Thêm Sản Phẩm</span>
                    </a>

                    <form action="{{ route('Administration.products.deleteMultiple') }}" method="POST"
                        style="padding: 10px">
                        @csrf
                        @method('DELETE')

                        @if (session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                        <table id="example" class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>
                                        <input type="checkbox" id="selectAll" class="form-check-input">
                                    </th>
                                    <th>Ảnh</th>
                                    <th>Tên Sản Phẩm</th>
                                    <th>Giá</th>
                                    <th>Trạng Thái</th>
                                    <th class="text-end">Hành động </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $product)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="products[]" value="{{ $product->product_id }}"
                                                class="form-check-input">
                                        </td>
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
                                            @if (isset($product->minPrice) && !empty($product->minPrice) && $product->minPrice < $product->maxPrice)
                                                <span
                                                    class="fw-bold text-danger">{{ number_format($product->minPrice, 0, ',', '.') . ' VNĐ' }}
                                                    - {{ number_format($product->maxPrice, 0, ',', '.') . ' VNĐ' }}</span>
                                            @else
                                                <span
                                                    class="fw-bold text-danger">{{ number_format($product->maxPrice, 0, ',', '.') . ' VNĐ' }}</span>
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
                                                <a href="{{ route('Administration.products.show', $product->product_slug) }}"
                                                    class="avatar-text avatar-md">
                                                    <i class="feather-eye"></i>
                                                </a>
                                                <a href="{{ route('Administration.products.edit', $product->product_slug) }}"
                                                    class="avatar-text avatar-md">
                                                    <i class="feather-edit"></i>
                                                </a>

                                                

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div style="display: flex; justify-content: space-around">
                            <button type="submit" class="btn btn-danger mb-3">
                                <i class="feather-trash-2 me-2"></i> Xóa 
                            </button>
                            <div>
                                <a href="{{ route('Administration.products.listDelete') }}"
                                    style="display: inline-block; color: white; background-color: #dc3545; border: 1px solid #ec4757; padding: 8px 16px; font-size: 14px; border-radius: 3px; text-align: center; text-decoration: none; line-height: 1.5; cursor: pointer; transition: background-color 0.2s, border-color 0.2s;">
                                    <i class="bi bi-trash3 me-2"></i>Thùng Rác
                                </a>


                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
