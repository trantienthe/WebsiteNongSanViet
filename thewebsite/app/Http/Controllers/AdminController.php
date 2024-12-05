<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function loginAdmin()
    {
       // dd(bcrypt(value: '123456789'));
        return view(view: 'login');
    }

    public function postLoginAdmin(Request $request)
    {
        $remember = $request -> has( key: 'remember_me') ? true : false;
        if (auth() -> attempt([
            'email' => $request -> email,
            'password' => $request -> password
        ], $remember)){
            return redirect()->to(path: 'home');
           // return view('home');
        }
    }
}
