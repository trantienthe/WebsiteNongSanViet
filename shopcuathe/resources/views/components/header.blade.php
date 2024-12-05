<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href=""><i class="fa fa-phone"></i> {{ getConfigValueFromSettingTable('SĐT') }}</a></li>
								<li><a href="https://mail.google.com/mail/u/0/#inbox"><i class="fa fa-envelope"></i> {{ getConfigValueFromSettingTable('email') }}</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li>
									<a href="{{ getConfigValueFromSettingTable('Facebook_link') }}"><i class="fa fa-facebook"></i>
									</a>
								</li>
								<li>
									<a href="{{ getConfigValueFromSettingTable('Facebook_link') }}"><i class="fa fa-linkedin"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="{{ URL::to('/') }}"><img height = '100px' src="/Eshopper/images/home/logoweb.jpg" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								
								<li>
									<a href="{{ route ('showCart') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a>
								</li>
							<?php
								$customer_id = Session::get('customer_id');
								$shipping_id = Session::get('shipping_id');
								if($customer_id != NULL && $shipping_id != NULL){
							?>
								<li>
									<a href="{{ URL::to('/checkout') }}"><i class="fa fa-crosshairs"></i>Thanh toán</a>
								</li>
							<?php
								}elseif($customer_id != NULL && $shipping_id != NULL){
							?>
								<li>
									<a href="{{ URL::to('/payment') }}"><i class="fa fa-crosshairs"></i>Thanh toán</a>
								</li>
							<?php
								}else{
							?>
								<li>
									<a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-crosshairs"></i>Thanh toán</a>
								</li>
							<?php
								}
							?>
								
							<?php
								$customer_id = Session::get('customer_id');
								if($customer_id != NULL){
							?>
								<li>
									<a href="{{ URL::to('/logout-checkout') }}"><i class="fa fa-lock"></i> Đăng Xuất</a>
								</li>
							<?php
								}else{
							?>
								<li>
									<a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-lock"></i>Đăng nhập</a>
								</li>
							<?php
								}
							?>
								
								<?php
								$customer_id = Session::get('customer_id');
								if($customer_id != NULL){
							?>
								<li>
									<a href="{{ URL::to('/') }}"><i class="fa fa-lock"></i>Đăng kí</a>
								</li>
							<?php
								}else{
							?>
								<li>
									<a href="{{ URL::to('/dangkiuser') }}"><i class="fa fa-lock"></i>Đăng kí</a>
								</li>
							<?php
								}
							?>	
								<?php
								$customer_id = Session::get('customer_id');
								if($customer_id != NULL){
							?>
								<li>
									<a href="{{ URL::to('/history') }}"><i class="fa fa-crosshairs"></i>Lịch sử mua hàng</a>
								</li>
							<?php
								}else{
							?>
								<li>
									<a href="{{ URL::to('/login-checkout') }}"><i class="fa fa-crosshairs"></i>Lịch sử mua hàng</a>
								</li>
							<?php
								}
							?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>


						@include('components.mainmenu')


					</div>
					
				</div>
				<div class="col-sm-12" >
					<form action="{{ URL::to('/tim-kiem') }}" method="POST">
						{{ csrf_field()}}
						<div class="search_box pull-right">
							<input type="text" name="keyword_submit" placeholder="Tìm kiếm sản phẩm"/>
						</div>
					</form>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->