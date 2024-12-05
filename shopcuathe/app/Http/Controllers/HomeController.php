<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()-> get();
        $categorys = Category::where('parent_id', 0)->get();
        $products = Product::latest() -> take(6) -> get();
        $productsRecommend = Product::latest('views_count', 'desc')->take(12)-> get();
        $CategorysLimit = Category::where('parent_id', 0)->take(3)->get();


        return view(view: 'home.home', data:compact('sliders', 'categorys', 'products', 'productsRecommend','CategorysLimit'));
    }


    //giohang
    public function addToCart($id, $quantity = 1){
        //session() -> flush('cart');

        $products = Product::find($id);
        $cart =  session() -> get(key: 'cart');
        if( isset($cart[$id]) ) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $quantity;
        }else{
            $cart[$id] = [
                'id' => $products -> id,
                'name' => $products -> name,
                'price' => $products -> price,
                'quantity' => $quantity,
                'image' => $products -> feature_image_path
            ];
        }
        session() -> put('cart', $cart);
        
        echo "<pre>";
        print_r(session() -> get(key: 'cart'));
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], status: 200);
    }

    public function addToCart2(Request $request){
        //session() -> flush('cart');

        $quantity = $request -> qty;
        $id = $request -> id;
        $products = Product::find($id);
        $cart =  session() -> get(key: 'cart');
        if( isset($cart[$id]) ) {
            $cart[$id]['quantity'] = $cart[$id]['quantity'] + $quantity;
        }else{
            $cart[$id] = [
                'id' => $products -> id,
                'name' => $products -> name,
                'price' => $products -> price,
                'quantity' => $quantity,
                'image' => $products -> feature_image_path
            ];
        }
        session() -> put('cart', $cart);
        return Redirect('/');
        echo "<pre>";
        print_r(session() -> get(key: 'cart'));
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ], status: 200);
        
        
    }

    
    public function showCart(){
       if(session() -> exists('cart')){
            $carts = session() -> get(key: 'cart');
            return view('product.carts.cart', data:compact('carts'));
       }

       return Redirect('/');
    }

    public function updateCart(Request $request){
        if ($request -> id && $request -> quantity) {
            $carts = session() -> get(key: 'cart');
            if($request -> quantity > 0){
                $carts[$request -> id]['quantity'] = $request -> quantity;
                session()->put('cart', $carts);
            }
            $cartComponent = view(view: 'product.components.cart_component', data:compact(var_name: 'carts'))->render();
            return response()->json(['cart_component' => $cartComponent , 'code' => 200], status: 200 );
        }
    }

    public function deleteCart(Request $request)
    {
        if ($request -> id) {
            $carts = session() -> get(key: 'cart');
            unset($carts[$request -> id]);
            session()->put('cart', $carts);
            $carts = session() -> get(key: 'cart');
            $cartComponent = view(view: 'product.components.cart_component', data:compact(var_name: 'carts'))->render();
            return response()->json(['cart_component' => $cartComponent , 'code' => 200], status: 200 );
        }
    }


    // TIM KIEM SP
    public function search(Request $request)
    {
        $keywords = $request->keyword_submit;
        $categorys = Category::where('parent_id', 0)->get();
        $search_product = DB::table('products')->where('name', 'like', '%' .$keywords. '%')->get();

        return view(view: 'product.search', data:compact(var_name: 'categorys'))->with('search_product', $search_product);
    }

    //lich su mua hang
    public function history() {
        $all_order = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=','tbl_customers.customer_id') 
        ->where('tbl_order.customer_id', '=',  session() -> get('customer_id'))  
        ->select('tbl_order.*','tbl_customers.customer_name')
        ->orderby('tbl_order.order_id', 'desc')->get();
        $manager_order = view('product.history')->with('all_order',$all_order);
        return view('product.history', data:compact(var_name: 'all_order')); 
    }
    //chi tiet mua hang
    public function view_order($orderId)
    {
        $order_by_id = DB::table('tbl_order')
        ->join('tbl_customers', 'tbl_order.customer_id', '=','tbl_customers.customer_id')
        ->join('tbl_shipping', 'tbl_order.shipping_id', '=','tbl_shipping.shipping_id')
        ->join('tbl_order_details', 'tbl_order.order_id', '=','tbl_order_details.order_id')
        ->join('products', 'tbl_order_details.product_id', '=','products.id')
        ->where('tbl_order.order_id', '=', $orderId)
        ->select('tbl_order.*','tbl_customers.*','tbl_shipping.*','tbl_order_details.*', 'products.*')->get();
        
        $manager_order_by_id = view('product.donhangchitiet')->with('order_by_id',$order_by_id);
        return view('product.donhangchitiet', data:compact(var_name: 'order_by_id'));
    }
    //xoa don hang
    public function delete_order($order_id) {
        DB::table('tbl_order_details')->where('order_id',$order_id)->delete();
        DB::table('tbl_order')->where('order_id',$order_id)->delete();
        Session::put('message','Xóa đơn hàng thành công');
        return Redirect::to('/');
    }

    //gui mail
    public function send_mail(Request $request) {
        $from_name = $request->contact_name; // ten nguoi gui
        $to_email = "the_2051220107@dau.edu.vn";//send to this email
        $subject = $request->contact_subject." - phản hồi từ Xwatch247";
        $data = array("name"=>$from_name,"emailKH"=>$request->contact_email,"body"=>$request->contact_message); //body of mail.blade.php

        Mail::send('pages.send_mail',$data,function($message) use ($from_name,$to_email,$subject){
            $message->to($to_email)->subject($subject);//send this mail with subject
            $message->from($to_email,$from_name);//send from this mail
        });
        Session::put('message','Đã gửi thành công, xin cảm ơn bạn');
        //return Redirect::to('/contact');
        return Redirect::to('/');
    }
    // public function contact(Request $request) {
    //     $meta_title = "Liên hệ";
    //     $meta_desc = "Đồng hồ giá tốt, chính hãng, thời trang với giá tiền phù hợp cho tất cả mọi người.";
    //     $meta_keywords = "đồng hồ, đồng hồ nam, watch store, đồng hồ nữ";
    //     $meta_canonical = $request->url();
    //     $image_og = "";
    //     $cate_product = DB::table('categories')->where('id','desc')->get();
        
    //     return view('pages.contact')
    //     ->with('meta_title',$meta_title)
    //     ->with('meta_desc',$meta_desc)
    //     ->with('meta_keywords',$meta_keywords)
    //     ->with('meta_canonical',$meta_canonical)
    //     ->with('image_og',$image_og);
    // }
}
