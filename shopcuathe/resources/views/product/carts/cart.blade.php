<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Show cart</title>
	<style>
		.chung3{
        	background: white;
        }
            .containerr{
				text-align: center;
                width: 80%;
                background: pink;
                margin: 0px auto;
                border: 2px solid black;
            }
            .cart{
                background: white;
                padding: 100px 0px;
            }
            .cart-top-wrap{
                background: pink;
                display: flex;
                justify-content: center;
                align-items: center;
            }
			
            .cart-top{
                height: 2px;
                width: 70%;
                background-color: #dddddd;
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin: 50px 0 100px;
            }
            .cart-top-item {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border: 1px solid #dddddd;
                display: flex;
                align-items: center;
                justify-content: center;
                background-color: #fff;
            }
            .cart-top-item i{
                color: #dddddd;
            }
            .cart-top-cart{
                border: 3px solid red;
            }
            .cart-top-cart{
                color: #0DB7EA;
            }

            .cart-content-left{
                background: pink;
                flex: 2;
                width: 95%;
                margin-left: 30px;
                padding-right: 0px;
            }
            .cart-content-left table {
                /* float: left; */
                width: 90%;
                text-align: center;
            }
        /*  .cart-content-right table {
                float: left;
                width: 50%;
                text-align: center;
            } */
            .cart-content-left table th {
                padding-bottom: 30px;
                font-family: var(--main-text-font);
                font-size: 12px;
                text-transform: uppercase;
                color: #333;
                border-collapse: collapse;
                border-bottom: 2px solid #dddddd;
            }
            .cart-content-left table p {
                font-family: var(--main-text-font);
                font-size: 12px;
                color: #333;
            }
            .cart-content-left table input{
                width: 30px;
            }
            .cart-content-left table span{
                display: block;
                width: 20px;
                height: 20px;
                border: 1px solid #dddddd;
                cursor: pointer;
            }
            .cart-content-left table td:first-child img{
                width: 130px;

            }
            .cart-content-left table td{
                padding: 20px 0;
                border-bottom: 2px solid #dddddd;
            }
            .cart-content-left td:nth-child(2){
                max-width: 130px;   
            }
            /* .cart-content-left td:nth-child(3) img{
                width: 30px;    
            } */

            .cart-content-right{
                background: pink;
                flex: 1;
                width: 95%;
                margin-left: 30px;
                padding-right: 0px;
                padding-left: 12px;
                border-left: 2px solid #dddddd;
                border-right: 2px solid #dddddd;
                border-top: 3px solid black;
                border-bottom: 2px solid #dddddd;
            }
            .cart-content-right table{
                width: 100%;
            }
            .cart-content-right table th {
                padding-bottom: 30px;
                font-family: var(--main-text-font);
                font-size: 12px;
                color: #333;
                border-collapse: collapse;
                border-bottom: 2px solid #dddddd;
            }
            .cart-content-right table td {
                font-family: var(--main-text-font);
                font-size: 12px;
                color: #333;
                padding: 6px 0;
            }
            .cart-content-right tr:nth-child(4){
                border-bottom: 2px solid #dddddd;

            }
            .cart-content-right tr td:last-child{
                text-align: right;  
            }
            .cart-content-right-text{
                margin: 20px 0;
                text-align: center;
            }
            .cart-content-right-text p {
                font-family: var(--main-text-font);
                font-size: 12px;
                color: #333;
            }
            .cart-content-right-button {
                text-align: center;
                align-items: center;
            }
            .cart-content-right-button button {
                padding: 0 18px;
                height: 35px;
                cursor: pointer;
            }
            .cart-content-right-button button:first-child{
                background-color: 1px solid black;
                margin-right: 20px;
            }
            .cart-content-right-button button:first-child:hover {
                background-color: #ddd;

            }
            .cart-content-right-button button:last-child{
                background-color: black;
                color: #fff;
                border: none;
                border: 1px solid black;
            }
            .cart-content-right-button button:last-child:hover {
                background-color: #dddddd;
                color: black;
            }
            .cart-content-right-dangnhap{
                margin-top: 20px;
            }
            .cart-content-right-dangnhap p{
                font-family: var(--main-text-font);
                font-size: 12px;
                color: #333;
                font-weight: bold;
            }
	</style>
</head>
<body>
    <div class="cart_wrapper">
        @include('product.components.cart_component')
    </div>

	
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(".quantity").each(function() {
        const quantityOld = $(this).val();
        $(this).on("change", function(e) {
            if ($(this).val() < 1) {
                $(this).val(quantityOld);
            }
        });
    });


    function cartUpdate(event) {
        event.preventDefault();
        let urlUpdateCart = $('.update_cart_url').data('url');
        let id = $(this).data('id');
        let quantity = $(this).parents('tr').find('input.quantity').val();

        $.ajax({
            type: "GET",
            url: urlUpdateCart,
            data: {id: id, quantity: quantity},
            success: function (data){
                if(data.code === 200){
                    $('.cart_wrapper').html(data.cart_component);
                    swal("Bạn đã cập nhập", "Thành công")
                }
            },
            error: function (event) {

            } 
        });
    }

    function cartDelete () {
        event.preventDefault();
        let urlDelete = $('.cart').data('url');
        let id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: urlDelete,
            data: {id: id},
            success: function (data){
                if(data.code === 200){
                    $('.cart_wrapper').html(data.cart_component);
                    swal("Bạn đã xóa", "Thành công")
                }
            },
            error: function (event) {

            } 
        });
    }

    $(function () {
        $(document).on('click', '.cart_update', cartUpdate);
        $(document).on('click', '.cart_delete', cartDelete);
    })

</script>

</body>
</html>

