@extends('admin.master')

@section('title', 'danh sách sản phẩm')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Products</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">List</li>
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
                        <span>Create Event</span>
                    </a>

                    <form action="{{ route('Administration.products.deleteMultiple') }}" method="POST">
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
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Product Image</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
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
                                                <a href="javascript:void(0);"
                                                    class="d-block">{{ $product->product_name }}</a>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"
                                                class="d-block mb-1">{{ $product->product_image }}</a>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);" class="d-block mb-1">
                                                @if ($product->status == 1)
                                                    Active
                                                @elseif ($product->status == 2)
                                                    Inactive
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

                                                <form style="border-radius: none"
                                                    action="{{ route('Administration.products.destroy', $product->product_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="avatar-text avatar-md"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa không?');">
                                                        <i class="feather-trash-2 "></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-danger mb-3">
                            <i class="feather-trash-2 me-2"></i> Delete
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
