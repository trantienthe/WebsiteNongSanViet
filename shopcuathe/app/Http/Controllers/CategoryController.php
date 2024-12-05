<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index($slug, $categoryId)
    {
        
        $CategorysLimit = Category::where('parent_id', 0)->take(3)->get();
        $products = Product::where('category_id', $categoryId)->paginate(12);
        $categorys = Category::where('parent_id', 0)->get();

        return view(view: 'product.category.list', data:compact('CategorysLimit', 'products','categorys'));
    }

    
}
