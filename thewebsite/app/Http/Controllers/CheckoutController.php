<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function manage_order()
    {
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=','tbl_customers.customer_id')
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id', 'desc')->get();
        $manager_order = view('admin.quanlidonhang')->with('all_order',$all_order);
        return view('admin.quanlidonhang', data:compact(var_name: 'all_order')); 
    }

    public function view_order($orderId)
    {
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=','tbl_customers.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=','tbl_shipping.shipping_id')
        ->join('tbl_order_details', 'tbl_order.order_id', '=','tbl_order_details.order_id')
        ->join('products', 'tbl_order_details.product_id', '=','products.id')
        ->where('tbl_order.order_id', '=', $orderId)
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*', 'products.*')->get();
        $manager_order_by_id = view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin.view_order', data:compact(var_name: 'order_by_id'));
    }

    public function update_order_qty(Request $request)
    {
        //update order
        $data = $request -> all();
        $order = Order::find($data['order_id']);
        $order -> order_status =  $data['order_status'];
        $order -> save();
        
        if($order -> order_status == 2){
            foreach($data['order_product_id'] as  $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product -> product_quantity;
                $product_sold = $product -> product_sold;

                foreach($data['quantity'] as $key2 => $qty){

                    if($key == $key2){
                        $pro_remain = $product_quantity - $qty;
                        $product -> product_quantity  =  $pro_remain;
                        $product -> product_sold = $product_sold + $qty;
                        $product -> save();
                    }
                }
            }
        }
        elseif($order -> order_status != 2 && $order -> order_status != 3){
            foreach($data['order_product_id'] as  $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product -> product_quantity;
                $product_sold = $product -> product_sold;

                foreach($data['quantity'] as $key2 => $qty){

                    if($key == $key2){
                        $pro_remain = $product_quantity;
                        $product -> product_quantity  =  $pro_remain;
                        $product -> product_sold = $product_sold;
                        $product -> save();
                    }
                }
            }
        }
      
    }

   
}
