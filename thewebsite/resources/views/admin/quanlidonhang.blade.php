@extends('layouts.admin')

@section('title')
    <title>Add product</title>
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

    @include('partials.content-header', ['name' => 'Customer', 'key' => 'List'])

    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Tên khách hàng</th>
                            <th scope="col">Tổng giá tiền</th>
                            <th scope="col">Tình trạng đơn hàng</th>
                            <th scope="col">Ngày đặt hàng</th>
                            <th scope="col">Hiển thị</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($all_order as $order)
                        <tr>
                            <td>{{ $order -> customer_name }}</td>
                            <td>{{ number_format($order -> order_total) }} VNĐ</td>
                            @if($order -> order_status == 1)
                                <td style ="color: blue;">Chưa xử lí</td>
                            @elseif($order -> order_status == 2)
                                <td style ="color: red;">Đã nhận hàng</td>
                            @elseif($order -> order_status == 4)
                                <td style ="color: red;">Kho hết hàng</td>
                            @else
                                <td style ="color: green;">Đang giao hàng</td>
                            @endif
                            <td>{{ $order -> created_at }}</td>
                            <td>
                                <a href="{{ URL::to('/view-order/'. $order -> order_id) }}" class="btn btn-primary">Thông tin đơn hàng</a>
                                
                            </td>
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

@endsection