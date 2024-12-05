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

<section id="form"><!--form-->
		<div class="container">
				<div class="col-sm-10">
					<div class="signup-form"><!--sign up form-->
						<h2>Đăng kí tài khoản </h2>
						<form action="{{ URL::to('add-customer') }}" method="POST">
                            {{ csrf_field() }}
							<input type="text" name="customer_name" placeholder="Họ và tên"/>
							<input type="email" name="customer_email" placeholder="Địa chỉ email"/>
							<input type="password" name="customer_password" placeholder="Mật khẩu"/>
                            <input type="text" name="customer_phone" placeholder="Số điện thoại"/>
							<button type="submit" class="btn btn-default">Đăng kí</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	@endsection