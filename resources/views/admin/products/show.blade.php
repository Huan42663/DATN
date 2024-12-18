@extends('admin.master')

@section('title', 'Chi Tiết Sản Phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Sản Phẩm</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.products.list') }}">Danh sách</a></li>
                <li class="breadcrumb-item">Chi tiết</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-xxl-4 col-xl-4">
                <div class="card stretch stretch-full">
                    <div class="card-body">
                        @foreach ($data1 as $product)
                            <div class="mb-4">
                                <div class="wd-150 ht-150 mx-auto mb-3 position-relative">

                                    <div class=" wd-150 ht-150 border border-5 border-gray-3">
                                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product Image"
                                            class="img-fluid"
                                            style="width: 100%;height: 100%;object-fit: cover;object-position: center; ">
                                    </div>
                                    <div class="wd-10 ht-10 text-success rounded-circle position-absolute translate-middle"
                                        style="top: 76%; right: 10px">
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <input placeholder="product name" style="border:none"
                                        class="text-center form-control fs-21 fw-bold d-block text-"
                                        value="{{ $product->product_name }}" disabled>
                                </div>
                                <div class="d-flex gap-2 text-center pt-1">
                                    <a href="{{ route('Administration.products.edit', $product->product_slug) }}">
                                        <i class="feather-edit me-2"> Chỉnh sửa </i>
                                    </a>
                                </div>
                                <div class="fs-12 fw-normal text-muted d-flex flex-wrap gap-3 mb-4">
                                    <div
                                        class="flex-fill py-3 px-4 rounded-1 d-none d-sm-block border border-dashed border-gray-5">
                                        <h6 class="fs-15 fw-bolder">Mô tả:</h6>
                                        <p> {!! $product->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xxl-8 col-xl-8">
                <div class="card border-top-0">
                    <div class="tab-content">

                        <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                            <div class="about-section mb-5">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0">Danh sách biến thể:</h5>
                                </div>
                            </div>
                            <div class="profile-details mb-5">
                                <a href="{{ route('Administration.products.create-variant-update') }}"
                                    class="text-decoration-none text-light">
                                    <button class="btn btn-primary">
                                        <i class="feather-plus me-2"></i>
                                        <span>Thêm mới </span>
                                    </button>
                                </a>
                                @if (session('message'))
                                    <div class="alert alert-success mt-2">
                                        {{ session('message') }}
                                    </div>
                                @endif
                                @if (session('error'))
                                    <div class="alert alert-danger mt-2">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                @if (isset($_SESSION['error']))
                                    <div class="alert alert-danger mt-2">
                                        Những biến thể bạn cập đã gặp lỗi tại
                                        @foreach ($_SESSION['error'] as $item)
                                            {{ $item }}
                                        @endforeach
                                    </div>
                                @endif
                                <form action="{{ route('Administration.products.deleteVariant') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" id=""
                                        value="{{ $data1[0]->product_id }}">

                                    <table id="example" class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Size</th>
                                                <th>Màu </th>
                                                <th>Giá </th>
                                                <th>Giá khuyến mãi </th>
                                                <th>Số lượng </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data2 as $key => $variant)
                                                <tr>
                                                    <td style="width: 5%">
                                                        <input type="checkbox" name="variant_id[]"
                                                            value="{{ $variant->product_variant_id }}" class="mt-2">
                                                        <input type="hidden" name="variant_id_update[]"
                                                            value="{{ $variant->product_variant_id }}" class="mt-2">

                                                    </td>
                                                    <td style="width: 10%">
                                                        <select name="size_id[]" id="" class="form-control">
                                                            @if ($variant->size_id == null)
                                                                <option value=""></option>
                                                            @endif
                                                            <option value=""></option>
                                                            @foreach ($data4 as $item)
                                                                @if($item->size_id == $variant->size_id)
                                                                <option value="{{ $item->size_id }}" selected>{{ $item->size_name }}</option>
                                                                @endif
                                                            @endforeach
                                                            @foreach ($data6 as $item)
                                                                @if($item->size_id == $variant->size_id)
                                                                    <option value="{{ $item->size_id }}" selected>{{ $item->size_name }}</option>
                                                                @else
                                                                    <option value="{{ $item->size_id }}">{{ $item->size_name }}</option>
                                                                @endif
                                                        @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="width: 21%">
                                                        <select name="color_id[]" id="" class="form-control">
                                                            @if ($variant->size_id == null)
                                                                <option value=""></option>
                                                            @endif
                                                            <option value=""></option>
                                                            @foreach ($data5 as $item)
                                                                <option value="{{ $item->color_id }}"
                                                                    @selected($item->color_name == $variant->color_name)>{{ $item->color_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td style="width: 25%">
                                                        <input type="number" name="price[]" min="1" max="9999999999"
                                                            value="{{ $variant->price }}" class="form-control">
                                                        <br>
                                                        @error('price.' . $key)
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="width: 25%">
                                                        <input type="number" name="sale_price[]" min="0" max="9999999999"
                                                            value="{{ $variant->sale_price }}" class="form-control">
                                                        <br> @error('sale_price.' . $key)
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td style="width: 14%">
                                                        <input type="number" name="quantity[]" min="1" max="9999999999"
                                                            value="{{ $variant->quantity }}" class="form-control">
                                                        <br> @error('quantity.' . $key)
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror

                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <div class="d-flex">
                                        <button class="btn btn-danger me-2" name="delete" value="delete"
                                            onclick="return confirm('Bạn có chắc muốn xóa biến thể không')">
                                            <i class="feather-minus me-2"></i>
                                            <span>Xóa Biến Thể</span>
                                        </button>
                                        <button class="btn btn-success" name="update" value="update">
                                            <i class="feather-minus me-2"></i>
                                            <span>Sửa Biến Thể</span>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="tab-pane fade show active p-4" id="overviewTab" role="tabpanel">
                            <div class="about-section mb-5">
                                <div class="mb-4 d-flex align-items-center justify-content-between">
                                    <h5 class="fw-bold mb-0">Danh sách ảnh:</h5>
                                </div>
                            </div>
                            <div class="profile-details mb-5">
                                <form action="{{ route('Administration.products.createListImages') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="file" name="imageColor[]" class="form-control" multiple>
                                        <input type="hidden" name="product_id" value="{{ $data1[0]->product_id }}"
                                            id="">
                                        <button type="submit" class="btn btn-primary text-light mt-1">
                                            <i class="feather-minus me-2"></i>
                                            <span>Thêm mới </span>
                                        </button>
                                    </div>
                                </form>
                                <form action="{{ route('Administration.products.destroyImage') }}" method="post">
                                    @csrf
                                    {{-- @method('DELETE') --}}
                                    <table id="example" class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Hình ảnh </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data3 as $variant)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="imageColor[]"
                                                            value="{{ $variant->image_color_id }}">
                                                    </td>
                                                    <td>

                                                        <div class="hstack gap-3">
                                                            <div>
                                                                <img width="100px"
                                                                    src="{{ asset('storage/' . $variant->image_color_name) }}"
                                                                    alt="{{ $variant->image_color_name }}">
                                                            </div>
                                                        </div>
                                                    </td>

                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="feather-minus me-2"></i>
                                        <span>Xóa </span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
