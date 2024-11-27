<div class="product-item grid-type style-1">
        <a href="{{route('Client.product.detail',$product->product_slug)}}">
        <div class="product-main cursor-pointer block">
            <div class="product-thumb bg-white relative overflow-hidden rounded-2xl">
                <div
                    class="product-tag text-button-uppercase bg-red px-3 py-0.5 inline-block rounded-full absolute top-3 left-3 z-[1] text-white">
                    Hot</div>
                {{-- <div class="list-action-right absolute top-3 right-3 max-lg:hidden">
                    <div
                        class="add-wishlist-btn w-[32px] h-[32px] flex items-center justify-center rounded-full bg-white duration-300 relative ">
                        <div class="tag-action bg-black text-white caption2 px-1.5 py-0.5 rounded-sm">Add To
                            Wishlist</div><svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            fill="currentColor" viewBox="0 0 256 256">
                            <path
                                d="M178,32c-20.65,0-38.73,8.88-50,23.89C116.73,40.88,98.65,32,78,32A62.07,62.07,0,0,0,16,94c0,70,103.79,126.66,108.21,129a8,8,0,0,0,7.58,0C136.21,220.66,240,164,240,94A62.07,62.07,0,0,0,178,32ZM128,206.8C109.74,196.16,32,147.69,32,94A46.06,46.06,0,0,1,78,48c19.45,0,35.78,10.36,42.6,27a8,8,0,0,0,14.8,0c6.82-16.67,23.15-27,42.6-27a46.06,46.06,0,0,1,46,46C224,147.61,146.24,196.15,128,206.8Z">
                            </path>
                        </svg>
                    </div>
                    <div
                        class="compare-btn w-[32px] h-[32px] flex items-center justify-center rounded-full bg-white duration-300 relative mt-2 ">
                        <div class="tag-action bg-black text-white caption2 px-1.5 py-0.5 rounded-sm">
                            Compare Product</div><svg xmlns="http://www.w3.org/2000/svg" width="18"
                            height="18" fill="currentColor" viewBox="0 0 256 256" class="compare-icon">
                            <path
                                d="M24,128A72.08,72.08,0,0,1,96,56H204.69L194.34,45.66a8,8,0,0,1,11.32-11.32l24,24a8,8,0,0,1,0,11.32l-24,24a8,8,0,0,1-11.32-11.32L204.69,72H96a56.06,56.06,0,0,0-56,56,8,8,0,0,1-16,0Zm200-8a8,8,0,0,0-8,8,56.06,56.06,0,0,1-56,56H51.31l10.35-10.34a8,8,0,0,0-11.32-11.32l-24,24a8,8,0,0,0,0,11.32l24,24a8,8,0,0,0,11.32-11.32L51.31,200H160a72.08,72.08,0,0,0,72-72A8,8,0,0,0,224,120Z">
                            </path>
                        </svg><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                            fill="currentColor" viewBox="0 0 256 256" class="checked-icon">
                            <path
                                d="M173.66,98.34a8,8,0,0,1,0,11.32l-56,56a8,8,0,0,1-11.32,0l-24-24a8,8,0,0,1,11.32-11.32L112,148.69l50.34-50.35A8,8,0,0,1,173.66,98.34ZM232,128A104,104,0,1,1,128,24,104.11,104.11,0,0,1,232,128Zm-16,0a88,88,0,1,0-88,88A88.1,88.1,0,0,0,216,128Z">
                            </path>
                        </svg>
                    </div>
                </div> --}}
                <div class="product-img w-full h-full aspect-[3/4]">
                    <img alt="Raglan Sleeve T-shirt"
                        fetchPriority="high" width="500" height="500" decoding="async" data-nimg="1"
                        class="w-full h-full object-cover duration-700" style="color:transparent"
                        srcSet="{{asset('storage/'.$product->product_image)}} 1x, {{asset('storage/'.$product->product_image)}} 2x"
                        src="{{asset('storage/'.$product->product_image)}}" />
                    <img
                        alt="Raglan Sleeve T-shirt" fetchPriority="high" width="500" height="500"
                        decoding="async" data-nimg="1" class="w-full h-full object-cover duration-700"
                        style="color:transparent"
                        srcSet="{{asset('storage/'.$product->product_image)}} 1x, {{asset('storage/'.$product->product_image)}} 2x"
                        src="{{asset('storage/'.$product->product_image)}}" />

                    {{-- <img src="{{asset('storage/'.$product->product_image)}}" alt=""> --}}

                </div>
                <div class="list-action grid grid-cols-2 gap-3 px-5 absolute w-full bottom-5 max-lg:hidden">
                    <div class="quick-view-btn w-full text-button-uppercase py-2 text-center rounded-full duration-300 " style="color:white;background-color:black;padding-top:3px ">
                      <a href="{{route('Client.product.detail',$product->product_slug)}}">Xem Thêm</a> 
                    </div>
                </div>
                <div class="list-action-icon flex items-center justify-center gap-2 absolute w-full bottom-3 z-[1] lg:hidden">
                    <a href="{{route('Client.product.detail',$product->product_slug)}}"><div class="quick-view-btn w-9 h-9 flex items-center justify-center rounded-lg duration-300 bg-white hover:bg-black hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                            fill="currentColor" viewBox="0 0 256 256" class="text-lg">
                            <path
                                d="M247.31,124.76c-.35-.79-8.82-19.58-27.65-38.41C194.57,61.26,162.88,48,128,48S61.43,61.26,36.34,86.35C17.51,105.18,9,124,8.69,124.76a8,8,0,0,0,0,6.5c.35.79,8.82,19.57,27.65,38.4C61.43,194.74,93.12,208,128,208s66.57-13.26,91.66-38.34c18.83-18.83,27.3-37.61,27.65-38.4A8,8,0,0,0,247.31,124.76ZM128,192c-30.78,0-57.67-11.19-79.93-33.25A133.47,133.47,0,0,1,25,128,133.33,133.33,0,0,1,48.07,97.25C70.33,75.19,97.22,64,128,64s57.67,11.19,79.93,33.25A133.46,133.46,0,0,1,231.05,128C223.84,141.46,192.43,192,128,192Zm0-112a48,48,0,1,0,48,48A48.05,48.05,0,0,0,128,80Zm0,80a32,32,0,1,1,32-32A32,32,0,0,1,128,160Z">
                            </path>
                        </svg>
                        </div>
                    </a>
                </div>
            </div>
            <div class="product-infor mt-4 lg:mb-7">
                <div class="text-title duration-300">{{$product->product_name}}</div>
                <div class="flex items-center gap-2 flex-wrap mt-1 duration-300 relative z-[1]">
                    <div class=" text-title">
                        @if ($product->minPrice > 0)
                            {{number_format($product->minPrice, 0, ',', '.') . ' VNĐ';}}
                        @else
                            {{number_format($product->maxPrice, 0, ',', '.') . ' VNĐ';}}
                        @endif
                    </div>
                    <div class="product-origin-price caption1 text-secondary2"><del>
                        @if ($product->minPrice > 0)
                            {{number_format($product->maxPrice, 0, ',', '.') . ' VNĐ';}}
                        @endif
                        </del>
                    </div>
                    @if ($product->minPrice > 0 && $product->maxPrice >0)
                        <div class="product-sale caption1 font-medium bg-green px-3 py-0.5 inline-block rounded-full">
                            {{($product->maxPrice - $product->minPrice)/$product->maxPrice * 100 .'%' }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </a>
</div>
