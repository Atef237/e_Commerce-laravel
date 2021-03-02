<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Http\Requests\AdminLogin;

class loginCon extends Controller
{
    public function login(){

        return view('admin.auth.login');

    }


    public function postLogin(AdminLogin $request){
        //return $request;

        //validation

        //check or add or .......
        
        if (auth()->guard('admin')->attempt(['email'=> $request->input('email'), 'password'=> $request->input('password')])){

            return redirect()->route('admin.dashboard');
        }
        return redirect()->back()->with(['error' => 'هناك خطأ بالبيانات']);
    }
}
