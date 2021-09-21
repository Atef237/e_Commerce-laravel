<?php


namespace App\Http\Services;


use App\Models\User;
use App\Models\Users_verfication;
use Illuminate\Support\Facades\Auth;

class pinCodeServices
{

    /** set OTP code for mobile
     * @param $data
     *
     * @return Users_verfication
     */

    public function sitPinCode($data){
        $pin_code = mt_rand(10000000 , 9999999999);
        $data['pin_code'] = $pin_code;

        Users_verfication::whereNotNull('user_id')->where(['user_id'=>$data['user_id']])->delete();
        return Users_verfication::create($data);

    }


    public function GetSMSMessage($pinCode){

        $message = 'your verification code for your account';

        return $pinCode.$message;
    }


    public function CheckPinCode($code){

        if(Auth::guard('user')->check()){
            //$loginUserId = Auth::id();

           $verificationData = Users_verfication::where('user_id',Auth::id()) -> first();

           if($verificationData -> pin_code == $code){
               User::whereId(Auth::id()) -> update(['email_verified_at' => now()]);

               return true;
           }else{
               return false;
           }
        }
    }

    public function removeCode($code){

        Users_verfication::where('pin_code',$code)->delete();

    }

}
