<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @yield('title')
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset ('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset ('adminlte/dist/css/adminlte.min.css') }}">
  @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  @include('partials.header')
  @include('partials.siderbar')

  @yield('content')
  
  @include('partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset ('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset ('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset ('adminlte/dist/js/adminlte.min.js') }}"></script>



<script>
  $('.order_details').change(function(){
    var order_status = $(this).val();
    var order_id = $(this).children(":selected").attr("id");
    var _token = $('input[name="_token"]').val();

    //lay ra so luong
    quantity = [];
    $("input[name='product_sales_quantity']").each(function(){
      quantity.push($(this).val());
    });
    //lay ra product id
    order_product_id = [];
    $("input[name='order_product_id']").each(function(){
      order_product_id.push($(this).val());
    });

    j=0;
    for(i = 0; i < order_product_id.length; i++ ){
      //soluong khach dat
      var order_qty = $('.order_qty_'+order_product_id[i]).val();
      //so luong ton kho
      var order_qty_storage = $('.order_qty_storage_'+order_product_id[i]).val();
      
      if(parseInt(order_qty) > parseInt(order_qty_storage))
      {
        j = j + 1;
        if(j == 1)
        {
          alert('Số lượng bán trong kho không đủ');
          $.ajax({
            url: '{{url('/update-order-qty')}}',

            method : 'POST',

            data:{_token:_token, order_status:order_status, order_id:order_id,
                  order_product_id:order_product_id},

            success:function(data){
              location.reload();

            }
          });
        }
        $('.color_qty_'+order_product_id[i]).css('background', 'red');
      }
    }

    if(j == 0){
        $.ajax({
        url: '{{url('/update-order-qty')}}',

        method : 'POST',

        data:{_token:_token, order_status:order_status, order_id:order_id, quantity:quantity,
              order_product_id:order_product_id},

        success:function(data){

          alert('xét duyệt đơn hàng thành công');
          location.reload();

        }
      });
    }

  });
</script>
@yield('js')
</body>
</html>
