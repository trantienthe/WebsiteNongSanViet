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
				<h2>Thông tin của bạn đã được ghi nhận</h2><br>
			</div>
          
			
			<form action="{{ URL::to('/order-place') }}" method="POST">
                {{ csrf_field() }}
                <div class="payment-options">
                    <h2>Vui lòng chọn hình thức thanh toán: </h2>
                        
                        <span>
                            <label><input name="payment_option" value="2" type="checkbox"> Thanh toán khi nhận hàng</label>
                        </span>
                        
                        <input type="submit" value="Đặt hàng" name="send_order_place" class="btn btn-primary btn-sm">
                </div>
            </form>
		</div>
	</section> <!--/#cart_items-->
	@endsection