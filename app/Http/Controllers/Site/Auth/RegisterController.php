<?php

namespace App\Http\Controllers\Site\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\RequesterRequest;
use App\Http\Services\pinCodeServices;
use App\Http\Services\SMSGateWays\VictoryLinkSMS;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public $pinCodeServices;

    public function __construct(pinCodeServices $pinCodeServices){

        $this->middleware('guest');
        $this -> pinCodeServices = $pinCodeServices;

    }

    public function getRegister(){
        return view('front.auth.register');
    }

    public function Register(RequesterRequest $request)
    {
       // return $request;

       // DB::beginTransaction();
           $verification = [];

           $user = $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' =>Hash::make($request->password),
            ]);

            //send pin code

            //generate pin code
            $verification['user_id'] = $user->id;
            $data = $this -> pinCodeServices -> sitPinCode($verification);

           # $message = $this -> pinCodeServices -> GetSMSMessage($data -> pin_code);

            // save this code in table vreification table
            # app(VictoryLinkSMS::class) -> sendSms($user -> mobile,$message);

            return redirect()->route('/');

       // DB::commit();
            //return $user;


       // DB::rollBack();
    }



}
