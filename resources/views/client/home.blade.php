@extends('client.master')

@section('title', 'trang chủ')

@section('content')
    @include('client.components.whate-new-block')

    @include('client.components.collection-block')

    @include('client.components.tab-features-block')

    @include('client.components.banner-block')

    @include('client.components.container')

    @include('client.components.testimonial-block')

    @include('client.components.instagram-block')

    @include('client.components.brand-block')
@endsection
