<!--! [Start] Header !-->
    <!--! ================================================================ !-->
    <header class="nxl-header">
        <div class="header-wrapper">
            <!--! [Start] Header Left !-->
            <div class="header-left d-flex align-items-center gap-4">
                <!--! [Start] nxl-head-mobile-toggler !-->
                <a href="javascript:void(0);" class="nxl-head-mobile-toggler" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
                <!--! [Start] nxl-head-mobile-toggler !-->
                <!--! [Start] nxl-navigation-toggle !-->
                <div class="nxl-navigation-toggle">
                    <a href="javascript:void(0);" id="menu-mini-button">
                        <i class="feather-align-left"></i>
                    </a>
                    <a href="javascript:void(0);" id="menu-expend-button" style="display: none">
                        <i class="feather-arrow-right"></i>
                    </a>
                </div>
                <!--! [End] nxl-navigation-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu-toggle !-->
                <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                    <a href="javascript:void(0);" id="nxl-lavel-mega-menu-open">
                        <i class="feather-align-left"></i>
                    </a>
                </div>
                <!--! [End] nxl-lavel-mega-menu-toggle !-->
                <!--! [Start] nxl-lavel-mega-menu !-->
                <div class="nxl-drp-link nxl-lavel-mega-menu">
                    <div class="nxl-lavel-mega-menu-toggle d-flex d-lg-none">
                        <a href="javascript:void(0)" id="nxl-lavel-mega-menu-hide">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>

                </div>
                <!--! [End] nxl-lavel-mega-menu !-->
            </div>
            <!--! [End] Header Left !-->
            <!--! [Start] Header Right !-->
            <div class="header-right ms-auto">
                <div class="d-flex align-items-center">
                    <div class="nxl-h-item d-none d-sm-flex">
                        <div class="full-screen-switcher">
                            <a href="javascript:void(0);" class="nxl-head-link me-0"
                                onclick="$('body').fullScreenHelper('toggle');">
                                <i class="feather-maximize maximize"></i>
                                <i class="feather-minimize minimize"></i>
                            </a>
                        </div>
                    </div>
                    <div class="nxl-h-item dark-light-theme">
                        <a href="javascript:void(0);" class="nxl-head-link me-0 dark-button">
                            <i class="feather-moon"></i>
                        </a>
                        <a href="javascript:void(0);" class="nxl-head-link me-0 light-button"
                            style="display: none">
                            <i class="feather-sun"></i>
                        </a>
                    </div>
                    @php
                        $order = (new App\Models\Order())::query()->where('status','unconfirm')->limit(8)->orderBy('order_id', 'DESC')->get();
                    @endphp
                    <div class="dropdown nxl-h-item">
                        <a class="nxl-head-link me-3" data-bs-toggle="dropdown" href="#" role="button"
                            data-bs-auto-close="outside">
                            <i class="feather-bell"></i>
                            <span class="badge bg-danger nxl-h-badge">@if(!empty($order) && count($order)>0) {{count($order)}} @else 0 @endif</span>
                        </a>
                        @if(!empty($order) && count($order)>0)
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-notifications-menu">
                            <div class="d-flex justify-content-between align-items-center notifications-head">
                                <h6 class="fw-bold text-dark mb-0">Đơn Hàng Mới</h6>
                                <a href="javascript:void(0);" class="fs-11 text-success text-end ms-auto"
                                data-bs-toggle="tooltip" title="Đánh dấu đã đọc">
                                    <i class="feather-check"></i>
                                    <span>Đánh dấu đã đọc</span>
                                </a>
 
                            </div>
                            @php
                                $i=0;
                                foreach ($order as $value):
                            @endphp
                                @if ($i<=5)
                                <div class="notifications-item">
                                    <div class="notifications-desc">
                                        <a href="{{route('Administration.orders.show',$value->order_code)}}" class="font-body text-truncate-2-line"> <span
                                                class="fw-semibold text-dark">Họ và Tên: {{$value->fullname}}</span></a>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div class="notifications-date text-muted border-bottom border-bottom-dashed">
                                               {{$value->created_at}}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            @php
                                endforeach
                            @endphp
                            
                            <div class="text-center notifications-footer">
                                <a href="{{route('Administration.orders.list')}}" class="fs-13 fw-semibold text-dark">Tất cả đơn hàng</a>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if(Auth::check())
                    <div class="dropdown nxl-h-item">
                        <a href="javascript:void(0);" data-bs-toggle="dropdown" role="button"
                            data-bs-auto-close="outside">
                                <p>{{Auth()->user()->fullName}}</p>

                        </a>
                        <div class="dropdown-menu dropdown-menu-end nxl-h-dropdown nxl-user-dropdown">
                            <div class="dropdown-header">
                                <div class="d-flex align-items-center">
                                    <div>
                                        <h6 class="text-dark mb-0">{{Auth()->user()->fullName}}<span
                                                class="badge bg-soft-success text-success ms-1">{{Auth()->user()->role}}</span></h6>
                                        <span class="fs-12 fw-medium text-muted">{{Auth()->user()->email}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('Client.account.show')}}" class="dropdown-item">
                                <i class="feather-user"></i>
                                <span>Thông tin tài khoản</span>
                            </a>
                            <a href="{{route('Client.Home')}}" class="dropdown-item">
                                <i class="feather-settings"></i>
                                <span>Trang chủ</span>
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="{{route('Client.account.logout')}}" class="dropdown-item">
                                <i class="feather-log-out"></i>
                                <span>Đăng xuất </span>
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!--! [End] Header Right !-->
        </div>
    </header>
    <!--! ================================================================ !-->
    <!--! [End] Header !-->