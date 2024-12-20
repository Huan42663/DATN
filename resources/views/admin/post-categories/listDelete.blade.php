@extends('admin.master')

@section('title', 'Khôi phục danh mục bài viết')

@section('content')
    <div class="col-lg-12 mt-1">
        <div class="card stretch stretch-full">
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive" style="padding: 20px;">
                    <form action="{{ route('Administration.categoryPost.updateDelete') }}" method="POST">
                        @csrf
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Lựa chọn</th>
                                    <th>STT</th>
                                    <th>Tên danh mục</th>
                                    <th>Ngày xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($category_post as $value)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="category_post_id[]"
                                                value="{{ $value->category_post_id }}">
                                        </td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->category_post_name }}</td>
                                        <td>{{ $value->deleted_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success mt-2">Khôi phục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
