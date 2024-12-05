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
	
<div class="features_items">
						<h2 class="title text-center">KẾT QUẢ TÌM KIẾM</h2>
					@foreach($search_product as $product)
						<div class="col-sm-2">
					<a href="{{ URL::to('/chitietsanpham/' . $product -> id) }}">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{ $baseUrl . $product -> feature_image_path}}" alt="" />
											<h2>{{ number_format($product -> price) }} VNĐ</h2>
											<p>{{ $product -> name }}</p>
											<a href="#" 
												data-url = "{{ route('addToCart', ['id' => $product -> id]) }}"
												class="btn btn-primary add_to_cart">
												<i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
											</a>
										</div>
										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
									</ul>
								</div>
							</div>
					</a>
						</div>
					@endforeach
					</div>
	
@endsection

