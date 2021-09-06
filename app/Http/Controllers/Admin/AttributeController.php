<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttributeController extends Controller
{
    public function index(){

        $attributes = Attribute::orderBy('id','DESC')->paginate(pagination_count);
        return view('admin.attribute.index',compact('attributes'));

    }

    public function create(){

        return view('admin.attribute.create');

    }

    public function store(AttributeRequest $request){

       // return $request;

        $attribute = Attribute::create([
            'name' => $request->name,
        ]);

        return redirect()->route('attribute')->with(['success'=>'تمت الاضافة']);

    }

    public function destroy(){

    }

    public function edit($id){

        $attribute = Attribute::find($id);
        if(!$attribute)
            return redirect()->route('attribute')->with(['error' => 'هذا العنصر غير متاح']);
        else
            return view('admin.attribute.edit',compact('attribute'));

    }


    public function update(AttributeRequest $request, $id){

           // return 'done';
        try {
            //validation

            //update DB
            $attribute = Attribute::find($id);

            if (!$attribute)
                return redirect()->route('attribute')->with(['error' => 'هذا العنصر غير موجود']);


            DB::beginTransaction();

            //save translations
            $attribute->name = $request->name;
            $attribute->save();

            DB::commit();
            return redirect()->route('attribute')->with(['success' => 'تم ألتحديث بنجاح']);

        } catch (\Exception $ex) {

            DB::rollback();
            return redirect()->route('attribute')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

}
