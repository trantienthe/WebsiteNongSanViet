<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Components\MenuRecusive;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class MenuController extends Controller
{
    private $menuRecusive;
    private $menu;
    public function __construct(MenuRecusive $menuRecusive, Menu $menu)
    {
        $this -> menuRecusive = $menuRecusive;
        $this -> menu = $menu;
    }
    public function index()
    {
        $menus = $this -> menu -> paginate(10);
        return view(view: 'admin.menus.index', data:compact(var_name: 'menus'));
    }

    public function create()
    {
        $optionSelect = $this -> menuRecusive -> menuRecusiveAdd();
        return view(view: 'admin.menus.add', data:compact(var_name: 'optionSelect'));
    }

    public function store(Request $request)
    {
        $this -> menu -> create([
            'name' => $request -> name,
            'parent_id' => $request ->parent_id,
            'slug' => Str::slug($request -> name)
        ]);
        return redirect()->route(route: 'menus.index');
    }

    public function edit($id, Request $request)
    {
        $menuFollowIdEdit = $this -> menu -> find($id);
        $optionSelect = $this -> menuRecusive -> menuRecusiveEdit($menuFollowIdEdit->parent_id);
        return view(view: 'admin.menus.edit', data:compact('optionSelect', 'menuFollowIdEdit'));
    }

    public function update($id, Request $request)
    {
        $this -> menu -> find($id) ->update([
            'name'=> $request -> name,
            'parent_id' => $request -> parent_id,
            'slug' => Str::slug($request -> name)
        ]);

        return redirect() -> route(route: 'menus.index');
    }

    public function delete($id)
    {
        $this -> menu -> find($id) -> delete();

        return redirect() -> route(route: 'menus.index');
    }
    
}
