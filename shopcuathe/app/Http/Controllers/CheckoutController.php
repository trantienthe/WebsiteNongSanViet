<?php

namespace App\Http\Controllers;
use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Redirect;
use Cart;
use Session;



class CheckoutController extends Controller
{

    public function login_checkout()
    {
        return view('checkout.login_checkout');
    }

    public function add_customer (Request $request)
    {
        $data = array();
        $data['customer_name'] = $request -> customer_name;
        $data['customer_phone'] = $request -> customer_phone;
        $data['customer_password'] = md5($request -> customer_password);
        $data['customer_email'] = $request -> customer_email;

        $customer_id = DB::table('tbl_customers') -> insertGetId($data);

        Session::put('customer_id', $customer_id);
        Session::put('customer_name', $request -> customer_name);
        return Redirect('/checkout');
    }
    
    public function checkout()
    {   
        return view('checkout.show_checkout');
    }

    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request -> shipping_name;
        $data['shipping_phone'] = $request -> shipping_phone;
        $data['shipping_notes'] = $request -> shipping_notes;
        $data['shipping_email'] = $request -> shipping_email;
        $data['shipping_address'] = $request -> shipping_address;
  
        $shipping_id = DB::table('tbl_shipping') -> insertGetId($data);
  
        Session::put('shipping_id', $shipping_id);

        return Redirect('/payment');
    }
    public function payment()
    {
        return view('checkout.payment');
    }
    public function logout_checkout() {
        Session::flush();
        return Redirect('/');
    }

    public function login_customer(Request $request)
    {
        $email = $request -> email_account;
        $password = md5($request -> password_account);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
       
        if($result)
        {
            Session::put('customer_id', $result->customer_id);
            return Redirect('/');
        }else
        {
            return Redirect('/login-checkout');
        }
    }
    public function dangkiuser()
    {
        return view('checkout.dangkiuser');
    }
    
    public function order_place(Request $request) {
        //lay hinh thuc thanh toan
        $data = array();
        $data['payment_method'] = $request -> payment_option;
        $data['payment_status'] = '1';

        $payment_id = DB::table('tbl_payment') -> insertGetId($data);
  
        //insert order
        $carts = session() -> get(key: 'cart');
        foreach($carts as $id => $cartItem){

        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = $cartItem["price"] * $cartItem["quantity"];
        $order_data['order_status'] = '1';

        $order_id = DB::table('tbl_order') -> insertGetId($order_data);
        
        }
        //insert order_details
        $carts = session() -> get(key: 'cart');
        foreach($carts as $id => $cartItem){
            $order_d_data = array();
            $order_d_data['order_id'] = $order_id;
            $order_d_data['product_id'] = $cartItem["id"];
            $order_d_data['product_name'] =  $cartItem["name"];
            $order_d_data['product_price'] =  $cartItem["price"];
            $order_d_data['product_sales_quantity'] =  $cartItem["quantity"];

            $result = DB::table('tbl_order_details') -> insert($order_d_data);
        }
        if($data['payment_method'] == 1){
            echo 'Thanh toán ATM';
        }elseif($data['payment_method'] == 2)
        {
            // delete session
            session()->forget('cart');
            return view('checkout.handcash');
        }else
        {
            echo 'Thanh toán thẻ ghi nợ';
        }

        //return Redirect('/payment');
    }
    
}
