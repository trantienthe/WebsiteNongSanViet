@extends('layouts.admin')

@section('title')
    <title>Chi tiết đơn hàng product</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('adminn/product/index/list.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('adminn\main.js') }}"></script>
    
@endsection

@section('content')

    <div class="content-wrapper">

    @include('partials.content-header', ['name' => 'Quản lí khách hàng', 'key' => ''])

    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <h2 style="text-align:center;" >Liệt kê chi tiết đơn hàng</h2>
                        <tr>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Tên người nhận</th>
                            <th scope="col">Số lượng trong kho còn</th>
                            <th scope="col">Số lượng người mua</th>
                            <th scope="col">Giá tiền</th>
                            <th scope="col">Tổng tiền</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($order_by_id as $order_by_id_item)
                        <tr class="color_qty_{{ $order_by_id_item-> product_id }}">
                            <td>{{ $order_by_id_item -> product_name}}</td>
                            <td>{{ $order_by_id_item -> shipping_name}}</td>
                            <td>{{ $order_by_id_item -> product_quantity}}</td>
                            <td>

                                <input type="number" min="1" class="order_qty_{{ $order_by_id_item-> product_id }}"
                                    value="{{ $order_by_id_item -> product_sales_quantity}}" 
                                    name="product_sales_quantity" >

                                <input type="hidden" name="order_product_id" class="order_product_id"
                                        value="{{ $order_by_id_item-> product_id }}">

                                <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{ $order_by_id_item-> product_id}}"
                                        value="{{ $order_by_id_item -> product_quantity }}">

                                

                            </td>
                            <td>{{ $order_by_id_item -> product_price}}</td>
                            <td>{{ $order_by_id_item -> product_price * $order_by_id_item -> product_sales_quantity}}</td>
                        </tr>
                        @endforeach
                        
                        <tr>
                            <td colspan="6">
                                @foreach($order_by_id as $or)
                                    @if($or -> order_status == 1)
                                    <form>
                                        @csrf
                                        <select class="form-control order_details">
                                            <option id="{{ $or -> order_id }}" selected value="1">Chưa xử lí</option>
                                            <option id="{{ $or -> order_id }}" value="2">Đã giao hàng</option>
                                            <option id="{{ $or -> order_id }}" value="3">Đang giao hàng</option>
                                            <option id="{{ $or -> order_id }}" value="4">Hết hàng . Hủy đơn !!!</option>
                                        </select>
                                    </form>
                                    @elseif($or -> order_status == 2)
                                    <form>
                                        @csrf
                                        <select class="form-control order_details">
                                            <option id="{{ $or -> order_id }}" value="1">Chưa xử lí</option>
                                            <option id="{{ $or -> order_id }}" value="2" selected>Đã giao hàng</option>
                                            <option id="{{ $or -> order_id }}" value="3">Đang giao hàng</option>
                                            <option id="{{ $or -> order_id }}" value="4">Hết hàng . Hủy đơn !!!</option>
                                        </select>
                                    </form>
                                    @elseif($or -> order_status == 4)
                                    <form>
                                        @csrf
                                        <select class="form-control order_details">
                                            <option id="{{ $or -> order_id }}" value="1">Chưa xử lí</option>
                                            <option id="{{ $or -> order_id }}" value="2" >Đã giao hàng</option>
                                            <option id="{{ $or -> order_id }}" value="3">Đang giao hàng</option>
                                            <option id="{{ $or -> order_id }}" value="4" selected>Hết hàng . Hủy đơn !!!</option>
                                        </select>
                                    </form>
                                    @else
                                    <form>
                                        @csrf
                                        <select class="form-control order_details">
                                            <option id="{{ $or -> order_id }}" value="1">Chưa xử lí</option>
                                            <option id="{{ $or -> order_id }}" value="2">Đã giao hàng</option>
                                            <option id="{{ $or -> order_id }}" value="3" selected>Đang giao hàng</option>
                                            <option id="{{ $or -> order_id }}" value="4">Hết hàng . Hủy đơn !!!</option>
                                        </select>
                                    </form>
                                    @endif
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
               
            </div>
        </div>
      </div>
    </div>
  </div>

    <hr>
    <hr>

  <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding-left:300px;">
                <table class="table">
                    <thead>
                    <h2 style="text-align:center;" >Thông tin khách hàng</h2>
                        <tr>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Số điện thoại</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td>{{ $order_by_id_item -> customer_name}}</td>
                            <td>{{ $order_by_id_item -> customer_phone}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-12">
               
            </div>
        </div>
      </div>
    </div>
  </div>

  <hr>
  <hr>

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
        </div>
      </div>
    </div>
  </div>
    <br>
    <br>
   
@endsection