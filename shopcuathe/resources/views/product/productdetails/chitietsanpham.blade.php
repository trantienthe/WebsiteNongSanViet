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
			@foreach($details_product as $key => $product)
    				<div class="product-details"><!--product-details-->

						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{ config('app.base_url') . $product -> feature_image_path }}" alt="" />
								<h3>ẢNH SẢN PHẨM</h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
										 	<a href=""></a>
										</div>
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
						
							<div class="product-information"><!--/product-information-->
							
								<img src="/Eshopper/images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{ $product -> name }}</h2>
								<p>Web ID: {{ $product -> id }}</p>
								<img src="" alt="" />
								<p><b>THƯƠNG HIỆU:</b> T-CENTURY</p>
								<p><b>TÌNH TRẠNG:</b> Còn hàng</p>
								<p><b>CHI TIẾT:</b>	{{ $product -> content }}</p>
								<form action="{{ URL::to('/add-to-cart') }}" method="POST">
									{{ csrf_field()}}
									<span>
										<span>{{ number_format($product -> price) . 'VNĐ' }}</span>
										<label>Số lượng</label>
										<input type="number" name="qty" min="1" max="20" value="1" />
										<input type="hidden" name="id" value="{{$product->id}}" />
										<button type="submit" class="btn btn-primary cart">
											<i class="fa fa-shopping-cart cart_update"></i>Thêm vào giỏ hàng
										</button>
									</span>
								</form>
							</div><!--/product-information-->
						
						</div>
					</div><!--/product-details-->
			@endforeach            		
@endsection