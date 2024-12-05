<html>
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        @yield('title')
        <link href="{{ asset('Eshopper/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('Eshopper/css/font-awesome.min.css') }}" rel="stylesheet">
        <link href="{{ asset('Eshopper/css/prettyPhoto.css') }}" rel="stylesheet">
        <link href="{{ asset('Eshopper/css/price-range.css') }}" rel="stylesheet">
        <link href="{{ asset('Eshopper/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('Eshopper/css/main.css') }}" rel="stylesheet">
        <link href="{{ asset('Eshopper/css/sweetalert.css') }}" rel="stylesheet">
        @yield('css')
    </head>
    
    <body>

        @include('components.header')

        @yield('content')

        @include('components.footer')

        <script src="{{ asset('Eshopper/js/jquery.js') }}"></script>
        <script src="{{ asset('Eshopper/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('Eshopper/js/jquery.scrollUp.min.js') }}"></script>
        <script src="{{ asset('Eshopper/js/price-range.js') }}"></script>
        <script src="{{ asset('Eshopper/js/jquery.prettyPhoto.js') }}"></script>
        <script src="{{ asset('Eshopper/js/main.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script src="{{ asset('Eshopper/js/sweetalert.min.js') }}"></script>
        
        

        <script>
            function addTocart(event){
                event.preventDefault();
                let urlCart = $(this).data('url');
                $.ajax({
                    type: "GET",
                    url: urlCart,
                    dataType: 'json',
                    success: function (data){
                        if(data.code === 200) {
                           
                        }
                    },
                    error: function (){
                         
                    }
                });
                swal("Bạn đã thêm vào giỏ hàng!", "Thành công")
            }
            $(function (){
                $('.add_to_cart').on('click', addTocart);
            });
        </script>
        @yield('js')
    </body>

</html>