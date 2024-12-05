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

<div class="chung3">
            <section class="cart" data-url={{ route('deleteCart') }}>
                <div class="containerr">
                    <h2>GIỎ HÀNG</h2>
                </div>
                <div class="containerr">
                    <div class="cart-content row">
                        <div class="cart-content-left">
                            <table class="table update_cart_url" data-url=" {{ route('updateCart') }}" >
                                <tr>
                                    <th>ID</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th>ACTION</th>
                                </tr>
                                @php
                                    $tongtien = 0;
                                    $tongsoluong = 0;
                                @endphp

                    @foreach($carts as $id => $cartItem)
                        @php
                            $tongtien += $cartItem['price'] * $cartItem['quantity'];
                            $tongsoluong += $cartItem['quantity'];
                        @endphp
                                <tr>
                                    <td>{{ $cartItem['id'] }}</td>
                                    <td><p>{{ $cartItem['name'] }}</p></td>
                                    <td><img style = "width: 100px; height: 100px" src="{{ config('app.base_url') . $cartItem['image'] }}" alt=""></td>
                                    <td><p>{{ number_format($cartItem['price']) }}</p></td>
                                    <td><input type="number" value="{{ $cartItem['quantity'] }}" min="1" class="quantity"></td>
                                    <td>{{ number_format($cartItem['price'] * $cartItem['quantity']) }} VNĐ</td>
                                    <td>
                                        <span>
                                            <a href="" data-id="{{ $id }}" class="btn btn-primary cart_update">Cập nhập</a>
                                            <a href="" data-id="{{ $id }}" class="btn btn-primary cart_delete">Xóa</a>
                                        </span>
                                    </td>
                                </tr>
                    @endforeach
                            </table>
                        </div>

                        <div class="cart-content-right">
                            <table>
                                <tr>
                                    <th colspan="2">Tổng tiền giỏ hàng</th>
                                </tr>
                                <tr>
                                    <td>TỔNG SẢN PHẨM</td>
                                    <td>{{ $tongsoluong }}</td>
                                </tr>
                                <tr>
                                    <td>PHÍ VẬN CHUYỂN</td>
                                    <td>0 VNĐ</td>
                                </tr>
                                <tr>
                                    <td>TỔNG TIỀN HÀNG</td>
                                    <td>{{ number_format($tongtien) }} VNĐ</td>
                                <tr>
                                    <td>SỐ TIỀN TẠM TÍNH</td>
                                    <td><p style="color: black; font-weight: bold;">{{ number_format($tongtien) }} VNĐ</p></td>
                                </tr>
                            </table>

                            
                            <div class="cart-content-right-button">
                                <button>
                                    <a href="{{ route('home') }}">TIẾP TỤC MUA SẮM</a>
                                </button>

                                <?php
								    $customer_id = Session::get('customer_id');
                                    if($customer_id != NULL){
                                ?>
                                    <button>
                                        <a href="{{ URL::to('/checkout') }}">THANH TOÁN</a>
                                    </button>
                                <?php
                                    }else{
                                ?>
                                    <button>
                                        <a href="{{ URL::to('/login-checkout') }}">THANH TOÁN</a>
                                    </button>
                                <?php
                                    }
                                ?>
                                
                            </div>

                        </div>
                    </div>
                </div>
            </section>
</div>
        @endsection