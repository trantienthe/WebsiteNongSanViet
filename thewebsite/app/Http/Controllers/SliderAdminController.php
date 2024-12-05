<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderAddRequest;
use App\Models\slider;
use App\Traits\StorageImageTrait;


use Illuminate\Http\Request;

class SliderAdminController extends Controller
{
    use StorageImageTrait;
    private $slider;
    public function __construct(Slider $slider){
        $this -> slider = $slider;
    }
    public function index(){
        $sliders = $this -> slider -> latest() -> paginate(5);
        return view(view: 'admin.slider.index', data:compact(var_name: 'sliders'));
    }

    public function create(){
        return view(view: 'admin.slider.add');
    }

    public function store(SliderAddRequest $request){
        try{
            $dataInsert = [
                'name' => $request -> name,
                'description' => $request -> description
            ];

            $dataImageSlider = $this -> storageTraitUpload($request, fieldName: 'image_path', foderName: 'slider');

            if(!empty($dataImageSlider)){
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
                $dataInsert['image_path'] = $dataImageSlider['file_path'];
            }   
            $this -> slider -> create($dataInsert);
            return redirect() -> route(route: 'slider.index');
        }catch (\exception $exception) {
             Log::error(message: 'Lỗi: ' . $exception -> getMessage() . 'dòng: ' . $exception -> getLine());
        }
    }

    public function edit($id){
        $slider = $this -> slider -> find($id);
        return view(view: 'admin.slider.edit', data:compact(var_name: 'slider'));
    }

    public function update(Request $request, $id){
        try{
            $dataUpdate = [
                'name' => $request -> name,
                'description' => $request -> description
            ];

            $dataImageSlider = $this -> storageTraitUpload($request, fieldName: 'image_path', foderName: 'slider');

            if(!empty($dataImageSlider)){
                $dataUpdate['image_name'] = $dataImageSlider['file_name'];
                $dataUpdate['image_path'] = $dataImageSlider['file_path'];
            }   
            $this -> slider -> find($id) -> update($dataUpdate);
            return redirect() -> route(route: 'slider.index');
        }catch (\exception $exception) {
             Log::error(message: 'Lỗi: ' . $exception -> getMessage() . 'dòng: ' . $exception -> getLine());
        }
    }

    public function delete($id){
        try{
            $this -> slider -> find($id) -> delete(); 
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
