<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Category;
use App\Models\Product;
use DB;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function details_product($id)
    {
        $sliders = Slider::latest()-> get();
        $categorys = Category::where('parent_id', 0)->get();
        $products = Product::latest() -> take(6) -> get();
        $productsRecommend = Product::latest('views_count', 'desc')->take(12)-> get();
        $CategorysLimit = Category::where('parent_id', 0)->take(3)->get();
        
        $details_product = DB::table('products')
        ->where('products.id', $id)-> get();

        return view(view: 'product.productdetails.chitietsanpham', data:compact('sliders', 
                                    'categorys', 'products', 'productsRecommend','CategorysLimit', 'details_product'));
    }

    
}
