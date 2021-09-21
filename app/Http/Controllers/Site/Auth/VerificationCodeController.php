<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\VerificationCode;
use App\Http\Services\pinCodeServices;
use Illuminate\Http\Request;

class VerificationCodeController extends Controller
{


    public $pinCodeServices;
    public function __construct(pinCodeServices $pinCodeServices){

        $this-> pinCodeServices = $pinCodeServices;
    }

    public function verification(){
        return view('front.auth.verification');
    }


    public function PostVerification(VerificationCode $request){

        // return $request -> code;

       $check = $this -> pinCodeServices ->CheckPinCode($request -> code);

       if($check){

           $this -> pinCodeServices->removeCode($request->code);
           return redirect()->route('/');

       }else{

           return redirect()->route('verification.form')->withErrors(['code' => 'كود التفعيل غير صحيح']);
       }


    }

}
