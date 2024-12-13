@extends('client.master')

@section('title', 'Chi tiết sự kiện')

@section('content')
    <div class="shop-product breadcrumb1 lg:py-20 md:py-14 py-10">
        <div class="container">
            <div class="list-product-block relative">
                {{-- <div class="filter-heading flex items-center justify-between gap-5 flex-wrap">
                    <div class="left flex has-line items-center flex-wrap gap-5">
                        <div class="choose-layout max-sm:hidden flex items-center gap-2">
                            <div
                                class="item three-col p-2 border border-line rounded flex items-center justify-center cursor-pointer ">
                                <div class="flex items-center gap-0.5"><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span></div>
                            </div>
                            <div
                                class="item four-col p-2 border border-line rounded flex items-center justify-center cursor-pointer active">
                                <div class="flex items-center gap-0.5"><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span></div>
                            </div>
                            <div
                                class="item five-col p-2 border border-line rounded flex items-center justify-center cursor-pointer ">
                                <div class="flex items-center gap-0.5"><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span><span
                                        class="w-[3px] h-4 bg-secondary2 rounded-sm"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="right flex items-center gap-3">
                        <div class="select-block filter-type relative"><select
                                class="caption1 py-2 pl-3 md:pr-12 pr-8 rounded-lg border border-line capitalize"
                                name="select-type" id="select-type">
                                <option value="Type" disabled="" selected="">Type</option>
                                <option class="item cursor-pointer ">t-shirt</option>
                                <option class="item cursor-pointer ">dress</option>
                                <option class="item cursor-pointer ">top</option>
                                <option class="item cursor-pointer ">swimwear</option>
                                <option class="item cursor-pointer ">shirt</option>
                                <option class="item cursor-pointer ">underwear</option>
                                <option class="item cursor-pointer ">sets</option>
                                <option class="item cursor-pointer ">accessories</option>
                            </select><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                fill="currentColor" viewBox="0 0 256 256"
                                class="absolute top-1/2 -translate-y-1/2 md:right-4 right-2">
                                <path
                                    d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z">
                                </path>
                            </svg></div>
                        <div class="select-block relative"><select id="select-filter" name="select-filter"
                                class="caption1 py-2 pl-3 md:pr-20 pr-10 rounded-lg border border-line">
                                <option value="Sorting" disabled="" selected="">Sorting</option>
                                <option value="soldQuantityHighToLow">Best Selling</option>
                                <option value="discountHighToLow">Best Discount</option>
                                <option value="priceHighToLow">Price High To Low</option>
                                <option value="priceLowToHigh">Price Low To High</option>
                            </select><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                fill="currentColor" viewBox="0 0 256 256"
                                class="absolute top-1/2 -translate-y-1/2 md:right-4 right-2">
                                <path
                                    d="M213.66,101.66l-80,80a8,8,0,0,1-11.32,0l-80-80A8,8,0,0,1,53.66,90.34L128,164.69l74.34-74.35a8,8,0,0,1,11.32,11.32Z">
                                </path>
                            </svg></div>
                    </div>
                </div> --}}
                <div class="list-filtered items-center gap-3 mt-4">
                    <div class="row">
                        <p class="fs-1">Sự Kiện: {{ $event->event_name }}</p>
                    </div>
                    <div class="whate-new-block">
                        <div class="container">
                            <div
                                class="list-product hide-product-sold grid lg:grid-cols-4 grid-cols-2 sm:gap-[30px] gap-[20px] md:mt-10 mt-6">
        
                                @if ($products != [])
                                    @foreach ($products as $product)
                                        @include('client.components.whate-block', ['product' => $product])
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
