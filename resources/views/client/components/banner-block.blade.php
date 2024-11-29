<a class="banner-item relative block overflow-hidden duration-500" href="{{route('events.show',$event->slug)}}">
    <div class="banner-img"><img alt="banner1" fetchPriority="high" width="2000" height="1300"
            decoding="async" data-nimg="1" class="duration-1000" style="color:transparent"
            srcSet="{{asset('storage/'.$event->banner)}} 1x, {{asset('storage/'.$event->banner)}} 2x"
            src="{{asset('storage/'.$event->banner)}}" /></div>
    <div class="banner-content absolute top-0 left-0 w-full h-full flex flex-col items-center justify-center">
        <div class="heading2 text-white">{{$event->event_name}}</div>
        <div
            class="text-button text-white relative inline-block pb-1 border-b-2 border-white duration-500 mt-2">
            Xem Thêm</div>
    </div>
</a>