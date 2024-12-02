@extends('client.master')

@section('title', 'Bài Viết')

@section('content')


<div class="blog grid md:py-20 py-10">
    <div class="container">
        <div class="list-blog grid lg:grid-cols-2 sm:grid-cols-2 md:gap-[42px] gap-8">
            @foreach($posts as $post)
            <div class="blog-item style-one h-full cursor-pointer">
                <div class="blog-main h-full block">
                    <!-- <div class="blog-thumb rounded-[20px] overflow-hidden">
                            
                            <img alt="blog-img" loading="lazy" width="2000" height="1500" decoding="async"
                                 class="w-full duration-500"
                                 style="color:transparent"
                                 src="" />
                        </div> -->
                    <div class="flex items-center gap-2 mt-2">
                        <div class="blog-date caption1 text-secondary">
                            {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    <div class="blog-infor mt-7">

                        <div class="blog-tag bg-green py-1 px-2.5 rounded-full text-button-uppercase inline-block">
                            {{ $post->categoryPost->category_post_name }}
                        </div>

                        <div class="heading6 blog-title mt-3 duration-300"> <a href="{{ route('Client.posts.detail', ['slug' => $post->slug]) }}">{{ $post->title }}</a></div>

                        <div class="blog-description mt-3 duration-250">
                            {{ $post->short_description }}
                        </div>
                        <div class="blog-content mt-3 duration-300">
                        {{ strlen($post->content) > 20 ? substr($post->content, 0, 20) . '...' : $post->content }}

                        </div>

                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!--  phân trang  -->
       <div class="mt-5">
    {{ $posts->links() }}
</div>


    </div>
</div>
@endsection