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
<div class="content">
  <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                        <h2 style="text-align:center;" >Thông tin vận chuyển</h2>
                            <th scope="col">Tên người nhận hàng</th>
                            <th scope="col">Địa chỉ</th>
                            <th scope="col">Số điện thoại</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($order_by_id as $order_by_id_item)
                        <tr>
                            <td>{{ $order_by_id_item -> shipping_name}}</td>
                            <td>{{ $order_by_id_item -> shipping_address}}</td>
                            <td>{{ $order_by_id_item -> shipping_phone}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
               
            </div>

            <div class="col-md-12">
                <table class="table">
                    <thead>
                    <h2 style="text-align:center;" >Liệt kê chi tiết đơn hàng</h2>
                        <tr>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá tiền</th>
                            <th scope="col">Tổng tiền</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($order_by_id as $order_by_id_item)
                        <tr>
                            <td>{{ $order_by_id_item -> product_name}}</td>
                            <td>{{ $order_by_id_item -> product_sales_quantity}}</td>
                            <td>{{ $order_by_id_item -> product_price}}</td>
                            <td>{{ $order_by_id_item -> product_price * $order_by_id_item -> product_sales_quantity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
      </div>
    </div>
@endsection

