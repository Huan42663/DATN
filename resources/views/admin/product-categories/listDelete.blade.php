@extends('admin.master')

@section('title', 'Restore product catalog')

@section('content')
    <div class="col-lg-12 mt-1">
        <div class="card stretch stretch-full">
            <div class="card-body custom-card-action p-0">
                <div class="table-responsive" style="padding: 20px;">
                    <form action="{{ route('Administration.categoryProduct.updateDelete') }}" method="POST">
                        @csrf
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>STT</th>
                                    <th>Category Name</th>
                                    <th>Date of Deletion</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($categories as $value)
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="category_id[]" value="{{ $value->category_id }}">
                                        </td>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $value->category_name }}</td>
                                        <td>{{ $value->deleted_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-success mt-2">Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
