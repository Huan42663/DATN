@extends('admin.master')

@section('title', 'Banner')

@section('page-header')
    <div class="page-header">
        <div class="page-header-left d-flex align-items-center">
            <div class="page-header-title">
                <h5 class="m-b-10">Banners</h5>
            </div>
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ Route('Administration.Home') }}">Home</a></li>
                <li class="breadcrumb-item">List</li>
            </ul>
        </div>
    </div>
@endsection

@section('content')


    <!-- [ page-header ] start -->

    <div class="col-lg-12 mt-3">
        <div class="card stretch stretch-full">
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive">
                    <a href="{{ route('Administration.banners.create') }}" class=" btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Tạo sự kiện</span>
                    </a>
                    <table id="example" class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Banner Image</th>
                                <th>Event</th>
                                <th>Status</th>
                                <th>Product</th>
                                <th class="text-end">Hành động</th>
                                {{-- <th>Link</th> --}}
                                {{-- <th class="text-end">Hành động</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($banners as $banner)
                                <tr>
                                    <td>{{ $banner->banner_id }}</td>
                                    <td>
                                        <div class="hstack gap-3">

                                            <div>
                                                <img src="{{ asset('storage/' . $banner->image_name) }}" alt="" style="width: 60px; height: 60px;">
                                            </div>
                                        </div>
                                    </td>x
                                    <td>
                                        <span class="d-block mb-1">{{ $banner->event_name }}</span>
                                    </td>
                                    <td>
                                        @if ($banner->status == '1')
                                            <span class="badge bg-soft-primary text-primary"> Đang hoạt động</span>
                                        @elseif ($banner->status == '0')
                                            <span class="badge bg-soft-danger text-danger"> Ngừng hoạt động</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="d-block mb-1">{{ $banner->product_name }}</span>
                                    </td>
                                    <td class="text-end">
                                        <div class="hstack gap-2 justify-content-end">
                                            {{-- <a href="" class="avatar-text avatar-md">
                                                <i class="feather-eye"></i>
                                            </a> --}}
                                            <a href="{{ route('Administration.banners.edit', $banner->banner_id) }}" class="avatar-text avatar-md">
                                                <i class="feather-edit"></i>
                                            </a>
                                            <form action="{{ route('Administration.banners.destroy', $banner->banner_id) }}" method="POST"
                                                onsubmit="return confirm('Bạn có chắc chắn muốn xóa banner này không?')">
                                              @csrf
                                              @method('DELETE')
                                              <button type="submit" class="avatar-text avatar-md text-danger" style="border: none; background: transparent;">
                                                  <i class="feather-trash-2"></i>
                                              </button>
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
    <!-- [ Main Content ] end -->
@endsection
