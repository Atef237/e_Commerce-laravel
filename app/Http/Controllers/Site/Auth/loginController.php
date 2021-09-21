<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLogin;
use App\Http\Requests\User\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{

    public function getLogin(){
        return view('front.auth.login');
    }

    public function postlogin(Request $request)
    {

          // return $request;

        if (Auth()->guard('user')->attempt(['email'=> $request->input('email'), 'password'=> $request->input('password')])){
            return redirect()->route('/');

        }else{
            return redirect()->back();
        }

    }


    public function getGaurd(){
        return auth('user');
    }
}
