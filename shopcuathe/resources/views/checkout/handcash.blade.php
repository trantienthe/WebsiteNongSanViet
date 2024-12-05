@extends('layouts.master')

@section('title')
	<title>Home Page</title>
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset ('home/home.css') }}">
@endsection

@section('js')
	<link rel="stylesheet" href="{{ asset ('home/home.js') }}">
@endsection

@php
    $baseUrl = config('app.base_url');
@endphp

@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="review-payment">
				<h2>Bạn đã đặt hàng thành công</h2>
                <h2>Cảm ơn bạn đã mua hàng tại shop của chúng tôi<br>
                    --Chúng tôi sẽ liên hệ bạn sớm nhất--
                </h2>
			</div>
			
		</div>
	</section> <!--/#cart_items-->
	@endsection