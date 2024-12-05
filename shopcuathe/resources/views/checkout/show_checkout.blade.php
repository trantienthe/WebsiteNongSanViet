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

			<div class="register-req">
				<p>Làm ơn đăng kí và đăng nhập để dễ dàng thanh toán và xem lại lịch sử mua hàng</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					
					<div class="col-sm-12 clearfix">
						<div class="bill-to">
							<p>Điền thông tin vào mẩu để gửi hàng:</p>
							<div class="form-one">
								<form action="{{ URL::to('/save-checkout-customer') }}" method="POST">
									{{ csrf_field()}}
									<input type="text" name="shipping_email" class="shipping_email" placeholder="Điền Email*">
									<input type="text" name="shipping_name" class="shipping_name" placeholder="Họ tên người nhận hàng*">
									<input type="text" name="shipping_phone" class="shipping_phone" placeholder="Sô điện thoại">
									<input type="text" name="shipping_address" class ="shipping_address" placeholder="Địa chỉ gửi hàng">
									<textarea  name="shipping_notes" placeholder="Ghi chú đơn hàng của bạn" class ="shipping_notes" rows="16"></textarea>
									<input type="submit" value="Xác nhận đặt hàng" name= "send_other" class="btn btn-primary btn-sm">
								</form>
							</div>
						</div>
					</div>
									
				</div>
			</div>
		</div>
	</section> <!--/#cart_items-->
	
	<script>
		$(document).ready(function(){
			$('.add-to-cart').click(function(){
				var shipping_email = $('.shipping_email').val();
				var shipping_name = $('.shipping_name').val();
				var shipping_phone = $('.shipping_phone').val();
				var shipping_address = $('.shipping_address').val();
				var shipping_notes = $('.shipping_notes').val();

				$.ajax({
					url: '{{url('/confirm-order')}}',
					method: "POST",
					data:{shipping_email:shipping_email, shipping_name:shipping_name, shipping_phone:shipping_phone, 
						shipping_address:shipping_address, shipping_notes:shipping_notes},
					success:function(){
						alert('Đạt hàng thành công');
					}

				});
				

			});
		});
		
	</script>
	@endsection