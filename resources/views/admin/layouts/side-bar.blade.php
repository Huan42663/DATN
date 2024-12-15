<!--! [Start] Navigation Manu !-->
<!--! ================================================================ !-->
<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a
            class="flex items-center max-lg:absolute max-lg:left-1/2 max-lg:-translate-x-1/2"
            href="{{route('Administration.Home')}}">
            <div class="fs-3 fw-bold logo logo-lg" >JSTORE</div>
            <div class="fs-6 fw-bold logo logo-sm" >JSTORE</div>
            </a>
            {{-- <a href="index.html" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="/admin/assets/images/logo-full.png" alt="" class="logo logo-lg" />
                <img src="/admin/assets/images/logo-abbr.png" alt="" class="logo logo-sm" />
            </a> --}}
        </div>
        <div class="navbar-content">
            <ul class="nxl-navbar">
                <li class="nxl-item nxl-caption">
                    <label>Navigation</label>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="bi bi-card-list"></i></span>
                        <span class="nxl-mtext">Danh Mục Bài Viết</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.categoryPost.list')}}">Danh sách</a>
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.categoryPost.create')}}">Thêm mới</a></li>
                        </li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="bi bi-dash-square"></i></span>
                        <span class="nxl-mtext">Danh Mục Sản Phẩm</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.categoryProduct.list')}}">Danh sách</a>
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.categoryProduct.create')}}">Thêm mới</a></li>
                        </li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-tencent-qq" viewBox="0 0 16 16">
                            <path d="M6.048 3.323c.022.277-.13.523-.338.55-.21.026-.397-.176-.419-.453s.13-.523.338-.55c.21-.026.397.176.42.453Zm2.265-.24c-.603-.146-.894.256-.936.333-.027.048-.008.117.037.15.045.035.092.025.119-.003.361-.39.751-.172.829-.129l.011.007c.053.024.147.028.193-.098.023-.063.017-.11-.006-.142-.016-.023-.089-.08-.247-.118"/>
                            <path d="M11.727 6.719c0-.022.01-.375.01-.557 0-3.07-1.45-6.156-5.015-6.156S1.708 3.092 1.708 6.162c0 .182.01.535.01.557l-.72 1.795a26 26 0 0 0-.534 1.508c-.68 2.187-.46 3.093-.292 3.113.36.044 1.401-1.647 1.401-1.647 0 .979.504 2.256 1.594 3.179-.408.126-.907.319-1.228.556-.29.213-.253.43-.201.518.228.386 3.92.246 4.985.126 1.065.12 4.756.26 4.984-.126.052-.088.088-.305-.2-.518-.322-.237-.822-.43-1.23-.557 1.09-.922 1.594-2.2 1.594-3.178 0 0 1.041 1.69 1.401 1.647.168-.02.388-.926-.292-3.113a26 26 0 0 0-.534-1.508l-.72-1.795ZM9.773 5.53a.1.1 0 0 1-.009.096c-.109.159-1.554.943-3.033.943h-.017c-1.48 0-2.925-.784-3.034-.943a.1.1 0 0 1-.018-.055q0-.022.01-.04c.13-.287 1.43-.606 3.042-.606h.017c1.611 0 2.912.319 3.042.605m-4.32-.989c-.483.022-.896-.529-.922-1.229s.344-1.286.828-1.308c.483-.022.896.529.922 1.23.027.7-.344 1.286-.827 1.307Zm2.538 0c-.484-.022-.854-.607-.828-1.308.027-.7.44-1.25.923-1.23.483.023.853.608.827 1.309-.026.7-.439 1.251-.922 1.23ZM2.928 8.99q.32.063.639.117v2.336s1.104.222 2.21.068V9.363q.49.027.937.023h.017c1.117.013 2.474-.136 3.786-.396.097.622.151 1.386.097 2.284-.146 2.45-1.6 3.99-3.846 4.012h-.091c-2.245-.023-3.7-1.562-3.846-4.011-.054-.9 0-1.663.097-2.285"/>
                          </svg></span>
                        <span class="nxl-mtext">Sản Phẩm</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.products.list')}}">Danh sách</a>
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.products.create')}}">Thêm mới</a></li>
                        </li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="bi bi-card-image"></i></i></span>
                        <span class="nxl-mtext">Banner</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.banners.index')}}">Danh sách</a>
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.banners.create')}}">Thêm mới</a></li>
                        </li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="bi bi-calendar-event"></i></span>
                        <span class="nxl-mtext">Sự Kiện</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.events.list')}}">Danh sách</a>
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.events.create')}}">Thêm mới</a></li>
                        </li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="feather-users"></i></span>
                        <span class="nxl-mtext">Người Dùng</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.users.list')}}">Danh sách</a>
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.users.create')}}">Thêm quản trị viên</a></li>
                        </li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a class="nxl-link" href="{{route('Administration.orders.list')}}">
                        <span class="nxl-micon"><i class="bi bi-box-seam"></i></span>
                        <span class="nxl-mtext">Đơn hàng</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a class="nxl-link" href="{{route('Administration.sizes.list')}}">
                        <span class="nxl-micon"><i class="bi bi-aspect-ratio"></i></span>
                        <span class="nxl-mtext">Size</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a class="nxl-link" href="{{route('Administration.colors.list')}}">
                        <span class="nxl-micon"><i class="bi bi-palette"></i></span>
                        <span class="nxl-mtext">Màu</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon"><i class="bi bi-postcard"></i></span>
                        <span class="nxl-mtext">Bài viết</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.posts.list')}}">Danh Sách</a>
                        </li>
                        <li class="nxl-item"><a class="nxl-link"
                                href="{{route('Administration.posts.create')}}">Thêm Mới</a></li>
                    </ul>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a href="javascript:void(0);" class="nxl-link">
                        <span class="nxl-micon">
                            <i class="bi bi-ticket-detailed"></i></span>
                        <span class="nxl-mtext">Mã khuyến mãi</span><span class="nxl-arrow"><i
                                class="feather-chevron-right"></i></span>
                    </a>
                    <ul class="nxl-submenu">
                        <li class="nxl-item"><a class="nxl-link" href="{{route('Administration.vouchers.list')}}">Danh Sách</a>
                        </li>
                        <li class="nxl-item"><a class="nxl-link"
                                href="{{route('Administration.vouchers.create')}}">Thêm Mới</a>
                        </li>
                    </ul>
                </li>

            </ul>
            {{-- <div class="card text-center">
                <div class="card-body">
                    <i class="feather-sunrise fs-4 text-dark"></i>
                    <h6 class="mt-4 text-dark fw-bolder">Downloading Center</h6>
                    <p class="fs-11 my-3 text-dark">Duralux is a production ready CRM to get started up and running
                        easily.</p>
                    <a href="javascript:void(0);" class="btn btn-primary text-dark w-100">Download Now</a>
                </div>
            </div> --}}
        </div>
    </div>
</nav>
<!--! ================================================================ !-->
<!--! [End]  Navigation Manu !-->
