<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from anvogue.vercel.app/ by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 22 Sep 2024 15:05:21 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->

<head>
    <meta charSet="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
     <link rel="preload" href="{{asset('Client/_next/static/media/8de40de8211748f7.p.woff2')}}" as="font" crossorigin=""
        type="font/woff2" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('Client/_next/static/css/90e10e3e59879b4f.css')}}" crossorigin=""
        data-precedence="next" />
    <link rel="stylesheet" href="{{asset('Client/_next/static/css/73c00cd95dc66651.css')}}" crossorigin=""
        data-precedence="next" />
    <link rel="stylesheet" href="{{asset('Client/_next/static/css/5c4826c56b72a529.css')}}" crossorigin=""
        data-precedence="next" />
        {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
    <link rel="preload" as="script" fetchPriority="low" href="{{asset('Client/_next/static/chunks/webpack-8da1beb5d10bd904.js')}}" crossorigin="" />
    <script src="{{asset('Client/_next/static/chunks/fd9d1056-0111147e557ea71d.js')}}" async="" crossorigin=""></script>
    <script src="{{asset('Client/_next/static/chunks/2472-f21b1a1c55a1ee0b.js')}}" async="" crossorigin=""></script>
    <script src="{{asset('Client/_next/static/chunks/main-app-8ed6d57d180fb331.js')}}" async="" crossorigin=""></script>
    <script src="{{asset('Client/_next/static/chunks/4096-ee30c0e8d1e2e716.js')}}" async=""></script>
    <script src="{{asset('Client/_next/static/chunks/6691-e936c9ac45e85c82.js')}}" async=""></script>
    <script src="{{asset('Client/_next/static/chunks/4523-7f72d39383c7bfac.js')}}" async=""></script>
    <script src="{{asset('Client/_next/static/chunks/601-7705ded83711afd2.js')}}" async=""></script>
    <script src="{{asset('Client/_next/static/chunks/4408-9cc1fceed6474a16.js')}}" async=""></script>
    <script src="{{asset('Client/_next/static/chunks/7847-7fa3ca0a7fd6a8ce.js')}}" async=""></script>
    <script src="{{asset('Client/_next/static/chunks/app/layout-7793f540bf06f0cf.js')}}" async=""></script>
    <script src="{{asset('Client/_next/static/chunks/5283-80a7dcf6ef8fd3f9.js')}}" async=""></script>
    <script src="{{asset('Client/_next/static/chunks/732-c59a73b772a38500.js')}}" async=""></script>
    <script src="{{asset('Client/_next/static/chunks/3039-f7174115d3474b95.js')}}" async=""></script>
    <script src="{{asset('Client/_next/static/chunks/app/page-9c1a9eb91c437ae2.js')}}" async=""></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
     <title>JStore @yield('title')</title>
    <meta name="description" content="Multipurpose eCommerce Template" />
    <link rel="icon" href="favicon.ico" type="image/x-icon" sizes="16x16" />
    <script src="{{asset('Client/_next/static/chunks/polyfills-c67a75d1b6f99dc8.js')}}" crossorigin="" noModule=""></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Tai+Viet&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <style>
        .page-item.active .page-link {
         background-color: #ffff;
         border-color: black;
         color: black;
         }
 
         .page-item.disabled .page-link {
         color: #ffff;
         background-color: black;
         pointer-events: none;
         cursor: default;
         }
          .page-link {
         color: white;
         background-color: black;
         text-decoration: none;
         padding: 0.5rem 1rem;
         border: 1px solid black;
         border-radius: 0.25rem;
         margin:5px;
         } 
         .page-link:hover {
         color: black;
         background-color: #ffff;
         border-color: black;
         } 
         .text-muted{
             display: none;
         }
         .pagination{
             margin-bottom:20px;
             margin-top:20px;
         }
     </style>
</head>

<body class="__className_082e4d" style="background-color:rgb(249,246,241) ">
    
    @include('client.layouts.header')

    @yield('content')
    
    @include('client.layouts.footer')    

    {{-- @include('client.components.modal-newsletter')
    @include('client.components.modal-cart-block')    
    @include('client.components.modal-wishlist-block')    
    @include('client.components.modal-search-block')
    @include('client.components.modal-quickview-block')
    @include('client.components.modal-compare-block') --}}
    {{-- @vite('resources/js/voucher.js') --}}
    {{-- <script>
        import Swal from 'sweetalert2';

        // or via CommonJS
        const Swal = require('sweetalert2');
    </script> --}}
    <script lang="javascript">var __vnp = {code : 23689,key:'', secret : '4765841452632192fedf72e251b8f705'};(function() {var ga = document.createElement('script');ga.type = 'text/javascript';ga.async=true; ga.defer=true;ga.src = '//core.vchat.vn/code/tracking.js?v=46490'; var s = document.getElementsByTagName('script');s[0].parentNode.insertBefore(ga, s[0]);})();</script>
</body>
    
</html>
