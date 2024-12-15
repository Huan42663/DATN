@extends('client.master')
@section('title', 'Chi tiết Bài Viết')
@section('content')
<div class="container my-5">
    <div class="row">
        <!-- Cột chính: Hiển thị chi tiết bài viết -->
        <div class="col-lg-9">
            <div class="card shadow-sm p-4">
                <!-- Hiển thị tiêu đề bài viết -->
                <h1 class="text-primary fw-bold mb-3">{{ $post->title }}</h1>

                <!-- Hiển thị danh mục bài viết -->
                <div class="mb-3">
                    <span class="badge bg-success text-uppercase">{{ $post->categoryPost->category_post_name }}</span>
                </div>

                <!-- Hiển thị ngày đăng bài viết -->
                <div class="text-muted small mb-4">
                    Ngày đăng: {{ $post->created_at->format('d M, Y') }}
                </div>

                <!-- Hiển thị mô tả ngắn bài viết -->
                <div class="mb-4">
                    <p class="lead text-dark">{{ $post->short_description }}</p>
                </div>
                <!-- Hiển thị nội dung bài viết -->
                <div class="mb-4">
                    @foreach($textChunks as $index => $text)
                   

                    @if(isset($imageUrls[$index]))
                    <div class="image-item" style="display: flex; justify-content: center; align-items: center; margin: 20px 0;">
                        <img src="{{ $imageUrls[$index] }}" alt="{{ $post->title }}">
                    </div>
                    
                    @endif
                    <p>{{ $text }}</p>
                    @endforeach
                </div>
            </div>
        </div>
        <!--  Bài viết liên quan -->
        <div class="col-lg-3">
    <div class="card shadow-sm p-4 position-sticky" style="top: 20px;">
        <h5 class="blog-tag bg-green py-1 px-2.5 rounded-full text-button-uppercase inline-block text-center">Bài viết liên quan</h5>
        <ul class="list-group list-group-flush">
            @forelse ($relatedPosts as $relatedPost)
            <li class="list-group-item d-flex justify-content-between align-items-start">
                <div>
                    <a href="{{ route('Client.posts.detail', ['slug' => $relatedPost->slug]) }}" class="text-decoration-none text-primary fw-bold">
                        {{ $relatedPost->title }}
                    </a>
                    <small class="text-muted d-block">
                        {{ $relatedPost->description }}
                    </small>
                </div>
            </li>
            @empty
            <li class="list-group-item">
                <div class="text-muted">Không có bài viết liên quan.</div>
            </li>
            @endforelse
        </ul>
    </div>
</div>



    </div>
</div>


</div>



@endsection