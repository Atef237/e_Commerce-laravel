<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Models\Admin;
use App\Http\Requests\ProfileReq;

class profileCon extends Controller
{

    public  function showprofile(){
        //return auth('admin')->user()->id;

        $admin = Admin::find(auth('admin')->user()->id);

        return view('admin.profile.edit',compact('admin'));
    }

    public function updateprofile( ProfileReq $request){
        //validate

        try{

            $admin = Admin::find(auth('admin')->user()->id);

            $admin -> update($request);

            
            return redirect()->back()->with(['success' => 'تم التحديث ']);

        }catch (\Exception $exc){

            return redirect()->back()->with(['error' => 'هناك خطأ ما يرجي المحاولة في ما بعد ']);

        }

    }

}
