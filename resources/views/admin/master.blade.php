<!DOCTYPE html>
<html lang="zxx">


<!-- Mirrored from wphtml.com/html/tf/?storefront=envato-elements by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 Sep 2024 14:51:54 GMT -->

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="keyword" content="" />
    <meta name="author" content="WRAPCODERS" />
    <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
    <!--! BEGIN: Apps Title-->
    <title>JS Store || @yield('title')</title>
    <!--! END:  Apps Title-->
    <!--! BEGIN: Favicon-->
    <link rel="shortcut icon" type="image/x-icon" href="/admin/assets/images/favicon.ico" />
    <!--! END: Favicon-->
    <!--! BEGIN: Bootstrap CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/bootstrap.min.css" />
    <!--! END: Bootstrap CSS-->
    <!--! BEGIN: Vendors CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/assets/vendors/css/vendors.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/assets/vendors/css/daterangepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="/admin/assets/vendors/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="/admin/assets/vendors/css/select2-theme.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" />
    <!--! END: Vendors CSS-->
    <!--! BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="/admin/assets/css/theme.min.css" />
    <!--! END: Custom CSS-->
    <!--! HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries !-->
    <!--! WARNING: Respond.js doesn"t work if you view the page via file: !-->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <!--[if lt IE 9]>
   <script src="https:oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
   <script src="https:oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body>
    <!--! ================================================================ !-->
    @include('admin.layouts.side-bar')
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    @include('admin.layouts.header')
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! [Start] Main Content !-->
    <!--! ================================================================ !-->
    <main class="nxl-container">
        <div class="nxl-content">
            <div class="page-header">
                <div class="page-header-left d-flex align-items-center">
                    <div class="page-header-title">
                        <h5 class="m-b-10">@yield('model')</h5>
                    </div>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">@yield('function')</li>
                    </ul>
                </div>
                <div class="page-header-right ms-auto">
                    <div class="page-header-right-items">
                        <div class="d-flex d-md-none">
                            <a href="javascript:void(0)" class="page-header-right-close-toggle">
                                <i class="feather-arrow-left me-2"></i>
                                <span>Back</span>
                            </a>
                        </div>
                    </div>
                    <div class="d-md-none d-flex align-items-center">
                        <a href="javascript:void(0)" class="page-header-right-open-toggle">
                            <i class="feather-align-right fs-20"></i>
                        </a>
                    </div>
                </div>
            </div>

            @yield('content')

        </div>

        @include('admin.layouts.footer')
    </main>
    <!--! ================================================================ !-->
    <!--! [End] Main Content !-->
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    @include('admin.layouts.theme-customizer')
    <!--! ================================================================ !-->
    <!--! ================================================================ !-->
    <!--! Footer Script !-->
    <!--! ================================================================ !-->
    <!--! BEGIN: Vendors JS !-->
    <script src="/admin/assets/vendors/js/vendors.min.js"></script>
    <!-- vendors.min.js {always must need to be top} -->
    <script src="/admin/assets/vendors/js/daterangepicker.min.js"></script>
    <script src="/admin/assets/vendors/js/apexcharts.min.js"></script>
    <script src="/admin/assets/vendors/js/circle-progress.min.js"></script>
    <!--! END: Vendors JS !-->
    <script src="/admin/assets/vendors/js/select2.min.js"></script>
    <script src="/admin/assets/vendors/js/select2-active.min.js"></script>
    <!--! BEGIN: Apps Init  !-->
    <script src="/admin/assets/js/common-init.min.js"></script>
    <script src="/admin/assets/js/dashboard-init.min.js"></script>
    <!--! END: Apps Init !-->
    <!--! BEGIN: Theme Customizer  !-->
    <script src="/admin/assets/js/theme-customizer-init.min.js"></script>
    <!--! END: Theme Customizer !-->
    <script>
        new DataTable('#example');
    </script>
</body>


<!-- Mirrored from wphtml.com/html/tf/?storefront=envato-elements by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 Sep 2024 14:52:28 GMT -->

</html>
