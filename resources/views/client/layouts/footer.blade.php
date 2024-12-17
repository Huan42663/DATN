<div id="footer" class="footer">
    <div class="footer-main bg-surface">
        <div class="container">
            <div class="content-footer py-[60px] flex justify-between flex-wrap gap-y-8">
                <div class="company-infor basis-1/4 max-lg:basis-full pr-7"><a class="logo" href="{{route('Client.Home')}}">
                        <div class="heading4">JSTORE</div>
                    </a>
                    <div class="flex gap-3 mt-3">
                        <div class="flex flex-col "><span class="text-button">Mail:</span><span
                                class="text-button mt-3">Điện thoại:</span><span class="text-button mt-3">Địa chỉ:</span>
                        </div>
                        <div class="flex flex-col "><span class="">jstore@gmail.com</span><span
                                class="mt-3">0987654321</span><span class="mt-3 pt-px">549 Oak St.Crystal
                                Lake,
                                IL 60014</span></div>
                    </div>
                </div>
                @php
                $Category_post = (new App\Models\CategoryPost())::query()->where('showFooter', true)->get();
                $post =  (new App\Models\Post())::query()->get();
                @endphp
                <div class="right-content flex flex-wrap gap-y-8 basis-3/4 max-lg:basis-full">
                    <div class="list-nav flex justify-around basis-2/3 max-md:basis-full gap-4">
                        @foreach ($Category_post as $item )
                        <div class="item flex flex-col me-2">
                            <div class="text-button-uppercase pb-3">{{$item->category_post_name}}</div>
                            @php
                                $i=0;
                                foreach ($post as $value):
                                   
                            @endphp
                                @if($value->category_post_id == $item->category_post_id)
                                    <a class="caption1 has-line-before duration-300 w-fit" href="{{route('Client.posts.detail',$value->slug)}}">{{$value->title}}</a>
                                @endif
                            @php
                                endforeach
                            @endphp
                        </div>
                        @endforeach
                    </div>
                    <div class="newsletter basis-1/3 pl-7 max-md:basis-full max-md:pl-0">
                        <div class="text-button-uppercase">Bản tin </div>
                        <div class="caption1 mt-3">Đăng ký để nhận bản tin của chúng tôi và nhận 10% cho lần mua đầu tiên của bạn 
                        </div>
                        <div class="input-block w-full h-[52px] mt-4">
                            <form class="w-full h-full relative" action="https://anvogue.vercel.app/post"><input
                                    type="email" placeholder="Nhập e-mail của bạn "
                                    class="caption1 w-full h-full pl-4 pr-14 rounded-xl border border-line"
                                    required="" /><button
                                    class="w-[44px] h-[44px] bg-black flex items-center justify-center rounded-xl absolute top-1 right-1"><svg
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#fff"
                                        viewBox="0 0 256 256">
                                        <path
                                            d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z">
                                        </path>
                                    </svg></button></form>
                        </div>
                        <div class="list-social flex items-center gap-6 mt-4"><a target="_blank"
                                href="https://www.facebook.com/">
                                <div class="icon-facebook text-2xl text-black"></div>
                            </a><a target="_blank" href="https://www.instagram.com/">
                                <div class="icon-instagram text-2xl text-black"></div>
                            </a><a target="_blank" href="https://www.twitter.com/">
                                <div class="icon-twitter text-2xl text-black"></div>
                            </a><a target="_blank" href="https://www.youtube.com/">
                                <div class="icon-youtube text-2xl text-black"></div>
                            </a><a target="_blank" href="https://www.pinterest.com/">
                                <div class="icon-pinterest text-2xl text-black"></div>
                            </a></div>
                    </div>
                </div>
            </div>
            {{-- <div
                class="footer-bottom py-3 flex items-center justify-between gap-5 max-lg:justify-center max-lg:flex-col border-t border-line">
                <div class="left flex items-center gap-8">
                    <div class="copyright caption1 text-secondary">©2023 Anvogue. All Rights Reserved.</div>
                </div>
                <div class="right flex items-center gap-2">
                    <div class="caption1 text-secondary">Payment:</div>
                    <div class="payment-img"><img alt="payment" loading="lazy" width="500" height="500"
                            decoding="async" data-nimg="1" class="w-9" style="color:transparent"
                            srcSet="/_next/image?url=%2Fimages%2Fpayment%2FFrame-0.png&amp;w=640&amp;q=75 1x, /_next/image?url=%2Fimages%2Fpayment%2FFrame-0.png&amp;w=1080&amp;q=75 2x"
                            src="_next/Frame-00321.png?url=%2Fimages%2Fpayment%2FFrame-0.png&amp;w=1080&amp;q=75" />
                    </div>
                    <div class="payment-img"><img alt="payment" loading="lazy" width="500" height="500"
                            decoding="async" data-nimg="1" class="w-9" style="color:transparent"
                            srcSet="/_next/image?url=%2Fimages%2Fpayment%2FFrame-1.png&amp;w=640&amp;q=75 1x, /_next/image?url=%2Fimages%2Fpayment%2FFrame-1.png&amp;w=1080&amp;q=75 2x"
                            src="_next/Frame-1d6b2.png?url=%2Fimages%2Fpayment%2FFrame-1.png&amp;w=1080&amp;q=75" />
                    </div>
                    <div class="payment-img"><img alt="payment" loading="lazy" width="500" height="500"
                            decoding="async" data-nimg="1" class="w-9" style="color:transparent"
                            srcSet="/_next/image?url=%2Fimages%2Fpayment%2FFrame-2.png&amp;w=640&amp;q=75 1x, /_next/image?url=%2Fimages%2Fpayment%2FFrame-2.png&amp;w=1080&amp;q=75 2x"
                            src="_next/Frame-2cc38.png?url=%2Fimages%2Fpayment%2FFrame-2.png&amp;w=1080&amp;q=75" />
                    </div>
                    <div class="payment-img"><img alt="payment" loading="lazy" width="500" height="500"
                            decoding="async" data-nimg="1" class="w-9" style="color:transparent"
                            srcSet="/_next/image?url=%2Fimages%2Fpayment%2FFrame-3.png&amp;w=640&amp;q=75 1x, /_next/image?url=%2Fimages%2Fpayment%2FFrame-3.png&amp;w=1080&amp;q=75 2x"
                            src="_next/Frame-3779b.png?url=%2Fimages%2Fpayment%2FFrame-3.png&amp;w=1080&amp;q=75" />
                    </div>
                    <div class="payment-img"><img alt="payment" loading="lazy" width="500" height="500"
                            decoding="async" data-nimg="1" class="w-9" style="color:transparent"
                            srcSet="/_next/image?url=%2Fimages%2Fpayment%2FFrame-4.png&amp;w=640&amp;q=75 1x, /_next/image?url=%2Fimages%2Fpayment%2FFrame-4.png&amp;w=1080&amp;q=75 2x"
                            src="_next/Frame-4ee48.png?url=%2Fimages%2Fpayment%2FFrame-4.png&amp;w=1080&amp;q=75" />
                    </div>
                    <div class="payment-img"><img alt="payment" loading="lazy" width="500" height="500"
                            decoding="async" data-nimg="1" class="w-9" style="color:transparent"
                            srcSet="/_next/image?url=%2Fimages%2Fpayment%2FFrame-5.png&amp;w=640&amp;q=75 1x, /_next/image?url=%2Fimages%2Fpayment%2FFrame-5.png&amp;w=1080&amp;q=75 2x"
                            src="_next/Frame-50430.png?url=%2Fimages%2Fpayment%2FFrame-5.png&amp;w=1080&amp;q=75" />
                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</div>
