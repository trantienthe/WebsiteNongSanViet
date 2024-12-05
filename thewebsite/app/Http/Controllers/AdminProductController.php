<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use App\Models\ProductTag;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Http\Requests\ProductAddRequest;
use App\Components\Recusive;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use DB;

use Storage;

class AdminProductController extends Controller
{
    use StorageImageTrait;
    private $category;
    private $product;
    private $productImage;
    private $productTag;
    private $tag;
    public function __construct(Category $category, Product $product, ProductImage $productImage,
                                    Tag $tag, ProductTag $productTag)
    {
        $this -> category = $category;
        $this -> product = $product;
        $this -> productImage = $productImage;
        $this -> productTag = $productTag;
        $this -> tag = $tag;
    }

    public function index(){
        $products = $this -> product -> latest()-> paginate(5);
        return view(view: 'admin.product.index', data:compact(var_name: 'products'));
    }

    public function create(Request $request){
        $htmlOption = $this -> getCategory($parentId = '');
        return view(view: 'admin.product.add', data:compact(var_name: 'htmlOption'));
    }

    public function getCategory($parentId)
    {
        $data = $this -> category -> all();
        $recusive = new Recusive($data);
        $htmlOption = $recusive -> categoryRecusive($parentId);
        return $htmlOption;
    }

    public function store(ProductAddRequest $request)
    {
        try{
            DB::beginTransaction();
            $dataProductCreate = [
                'name' => $request -> name,
                'price' => $request -> price,
                'product_quantity' => $request -> product_quantity,
                'content' => $request -> contents,
                'user_id' => auth()->id(),
                'category_id' => $request -> category_id 
            ];

            $dataUploadFeatureImage = $this -> storageTraitUpload($request, fieldName: 'feature_image_path', foderName: 'product');
            if(!empty($dataUploadFeatureImage))
            {
                $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }
            $product = $this -> product -> create($dataProductCreate);
    
            //insert data to product_images
            if($request->hasFile(key: 'image_path')){
                foreach ($request->image_path as $fileItem){
                    $dataProductImageDetail = $this -> storageTraitUploadMutiple($fileItem, foderName: 'product');
                    $product -> images() -> create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                    
                }
            }
    
            //insert tags for product
            $tagIds = [];
            if(!empty($request -> tags)){
                foreach($request -> tags as $tagItem)
                {
                    //insert to tags
                    $tagInstance = $this -> tag -> firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance -> id;
                }
                
            }
            $product -> tags() -> attach($tagIds);
            
            
            DB::commit();
            return redirect() -> route (route: 'product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error(message: 'Lỗi: ' . $exception -> getMessage() . 'dòng: ' . $exception -> getLine());
        }
        

    }

    //sua san pham
    public function edit($id){
        $product = $this -> product -> find($id);
        $htmlOption = $this -> getCategory($product -> category_id);
        return view('admin.product.edit', data:compact('htmlOption','product'));
    }

    //cap nhap san pham
    public function update(Request $request, $id){
        try{
            DB::beginTransaction();
            $dataProductUpdate = [
                'name' => $request -> name,
                'price' => $request -> price,
                'product_quantity' => $request -> product_quantity,
                'content' => $request -> contents,
                'user_id' => auth()->id(),
                'category_id' => $request -> category_id 
            ];
            $dataUploadFeatureImage = $this -> storageTraitUpload($request, fieldName: 'feature_image_path', foderName: 'product');
            if(!empty($dataUploadFeatureImage))
            {
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            }

            $this -> product -> find($id) -> update($dataProductUpdate);
            $product = $this -> product -> find($id);
    
            //insert data to product_images
            if($request->hasFile(key: 'image_path')){
                $this -> productImage -> where('product_id', $id)-> delete();
                foreach ($request->image_path as $fileItem){
                    $dataProductImageDetail = $this -> storageTraitUploadMutiple($fileItem, foderName: 'product');
                    $product -> images() -> create([
                        'image_path' => $dataProductImageDetail['file_path'],
                        'image_name' => $dataProductImageDetail['file_name']
                    ]);
                    
                }
            }
    
            //insert tags for product
            $tagIds = [];
            if(!empty($request -> tags)){
                foreach($request -> tags as $tagItem)
                {
                    //insert to tags
                    $tagInstance = $this -> tag -> firstOrCreate(['name' => $tagItem]);
                    $tagIds[] = $tagInstance -> id;
                }
                
            }
            $product -> tags() -> sync($tagIds);
            
            DB::commit();
            return redirect() -> route (route: 'product.index');
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error(message: 'Lỗi: ' . $exception -> getMessage() . 'dòng: ' . $exception -> getLine());
        }
    }
    
    //xoa san pham
    public function delete ($id){
        try{
            $this -> product -> find($id) -> delete(); 
            return response() -> json([
                'code' => 200,
                'message' => 'success'
            ], status: 200 );
            
        }catch (\Exception $exception) {
            Log::error(message: 'Message: ' . $exception -> getMessage() . ' --- Line: ' . $exception -> getLine());
            return response() -> json([
                'code' => 500,
                'message' => 'fail'
            ], status: 500 );
        }
    }

}
