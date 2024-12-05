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
	
    
	
	<section>
		<div class="container">
			<div class="row">
                @include('components.sidebar')

				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">SẢN PHẨM</h2>
                        @foreach($products as $product)
						<div class="col-sm-4">
						<a href="{{ URL::to('/chitietsanpham/' . $product -> id) }}">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="{{ $baseUrl . $product -> feature_image_path}}" alt="" />
										<h2>{{ number_format($product -> price) }}VNĐ</h2>
										<p>{{ $product -> name }}</p>
										<a href="#" 
												data-url = "{{ route('addToCart', ['id' => $product -> id]) }}"
												class="btn btn-default add-to-cart">
												<i class="fa fa-shopping-cart"></i>Add to cart
											</a>	
									</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href=""><i class="fa fa-plus-square"></i>YÊU THÍCH</a></li>
										<li><a href=""><i class="fa fa-plus-square"></i>SO SÁNH</a></li>
									</ul>
								</div>
							</div>
							</a>
						</div>
                        @endforeach
						
						
						{{ $products -> links() }}
					</div><!--features_items-->
				</div>
			</div>
		</div>
	</section>
	
@endsection



	
	
	
	
	
