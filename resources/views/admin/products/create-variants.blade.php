@extends('admin.master')

@section('title', 'Thêm Biến Thể Sản Phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Sản phẩm </h5>
            </div>
            <ul class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="{{ Route('home') }}">Home</a></li> --}}
                <li class="breadcrumb-item"><a href="{{ url()->previous() }}">Thêm mới </a></li>
                <li class="breadcrumb-item">Thêm biến thể </li>
            </ul>
        </div>
    </div>
@endsection
@section('content')
    <div class="main-content">

        <div class="row">
            <div class="col-lg-12">
                <div class="card border-top-0">
                    <div class="tab-content">
                        <div class="card-body personal-info">
                            <div class="mb-4 d-flex align-items-center justify-content-between">
                                <h5 class="fw-bold mb-0 me-4">
                                    <span class="d-block mb-2">Biến thể :</span>
                                </h5>
                            </div>
                            @if (isset($_SESSION['data'][0]['action']) != '')
                                <form action="{{ route('Administration.products.createVariant2') }}" method="POST"
                                    enctype="multipart/form-data">
                                @else
                                    <form action="{{ route('Administration.products.createVariant1') }}" method="POST"
                                        enctype="multipart/form-data">
                            @endif
                            @csrf
                            <div class="row mb-4 align-items-center">
                                <table class="table" id="example">
                                    <thead>
                                        <th></th>
                                        <th>Size</th>
                                        <th>Màu </th>
                                        <th>Giá </th>
                                        <th>Giá khuyến mãi </th>
                                        <th>Số lượng </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($_SESSION['data'] as $item)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="stt[]" value="{{ $item['stt'] }}">
                                                </td>
                                                <td>
                                                    @foreach ($sizes as $sizeValue)
                                                        <span class="d-block mb-2 fs-16">
                                                            @if ($item['size_id'] == $sizeValue->size_id)
                                                                {{ $sizeValue->size_name }}
                                                            @break
                                                        @endif
                                                    </span>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($colors as $colorValue)
                                                    <span class="d-block mb-2 fs-16">
                                                        @if ($item['color_id'] == $colorValue->color_id)
                                                            {{ $colorValue->color_name }}
                                                        @break
                                                    @endif
                                                </span>
                                            @endforeach
                                        </td>

                                        <td>
                                            <input type="number" class="form-control" name="price" 
                                                value="{{ $item['price'] }}" id="" min="1" max="9999999999" disabled><br>
                                            @error('price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control"
                                                value="{{ $item['sale_price'] }}" name="sale_price"
                                                id="" min="0" max="9999999999" disabled><br>
                                            @error('sale_price')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                        <td>
                                            <input type="number" class="form-control"
                                                value="{{ $item['quantity'] }}" name="quantity" id="" min="0" max="99999" disabled><br>
                                            @error('quantity')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <button type="submit" class="btn btn-lg btn-light-brand col-4">Thêm </button>
                        <button type="submit" class="btn btn-lg btn-light-brand col-4" name="action"
                            value="delete">
                            Xóa biến thể
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<script></script>
<style>
table {
    width: 100%;
    border-collapse: collapse;
    font-family: 'Arial', sans-serif;
    margin-top: 10px;
}

table th {
    background-color: #f8f9fa;
    color: #333;
    text-align: center;
    padding: 12px;
    font-size: 14px;
    font-weight: 600;
    border-bottom: 2px solid #ddd;
}

table td {
    text-align: center;
    padding: 12px;
    font-size: 14px;
    font-weight: 400;
    color: #555;
    border: none;
    transition: border 0.3s ease;
    vertical-align: middle;
}

table tr:hover {
    background-color: #f1f1f1;
    cursor: pointer;
}

table td:hover {
    border: 1px solid rgba(0, 0, 0, 0.1);
}

table th,
table td {
    padding: 12px;
    border-left: 1px solid #eee;
}

table th:last-child,
table td:last-child {
    border-right: none;
}

table tr:last-child td {
    border-bottom: none;
}

table tr {
    height: 60px;
}

table td span {
    display: inline-block;
    vertical-align: middle;
}
</style>

@endsection
