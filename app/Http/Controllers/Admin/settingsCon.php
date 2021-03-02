<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use App\Models\setting;
use App\Http\Requests\shippingReq;
use DB;
class settingsCon extends Controller
{
    public function editShippingMethods($type){

        // methods shipping (free, inner, outer)

        if($type == 'free')
            $shipping = setting::where('key','free_shipping_label')->first();

        elseif($type == 'inner')
            $shipping = setting::where('key','local_lable')->first();

        elseif($type == 'outer')
            $shipping = setting::where('key','outer_lable')->first();

        else
            $shipping = "this method not exist";

            return view('admin.settings.shippings.edit',compact('shipping'));

    }

    public function updateShippingMethods(shippingReq $request ,$id){
        //return $request;
        try{
            DB::beginTransaction();

                $shipping_method = setting::find($id);

                $shipping_method ->update(['plain_value' => $request->plain_value]);
                //save translation

                $shipping_method -> value = $request->value;

                $shipping_method -> save();
            DB::commit();

                return redirect()->back()->with(['success' => 'تم التحديث ']);
        }catch(\Exception $exception){

            return redirect()->back()->with(['error' => 'هناك خطأ ما يرجي المحاولة في ما بعد ']);

            DB::rollback();
        }
        
        
    }
}
