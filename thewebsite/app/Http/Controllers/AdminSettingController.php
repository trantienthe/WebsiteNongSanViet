<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AddSettingRequest;
use App\Models\Setting;

class AdminSettingController extends Controller
{
    private $setting;

    public function __construct(Setting $setting)
    {
        $this -> setting = $setting;
    }

    public function index()
    {
        $settings = $this -> setting -> latest() -> paginate(5);
        return view(view: 'admin.setting.index', data:compact(var_name: 'settings'));
    }

    public function create()
    {
        return view(view: 'admin.setting.add');
    }

    public function store(AddSettingRequest $request)
    {
        $this -> setting -> create([
            'config_key' => $request -> config_key,
            'config_value' => $request -> config_value,
            'type' => $request -> type
        ]);
        return redirect()-> route(route: 'settings.index');
    }

    public function edit($id)
    {
        $setting = $this -> setting -> find($id);
        return view(view: 'admin.setting.edit', data:compact(var_name: 'setting') );
    }

    public function update(Request $request, $id)
    {
        $this -> setting -> find($id) -> update([
            'config_key' => $request -> config_key,
            'config_value' => $request -> config_value
        ]);

        return redirect()-> route(route: 'settings.index');
    }

    public function delete($id)
    {
        try{
            $this -> setting -> find($id) -> delete(); 
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
