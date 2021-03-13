<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandReq;
use App\Http\Requests\MainCategoryReq;
use App\Models\brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use function GuzzleHttp\Promise\all;

class BrandsCon extends Controller
{
    public function index(){

        $brands = brand::orderBy('id','DESC')->paginate(pagination_count);
        return view('admin.brands.index',compact('brands'));
    }

    public function edit($brand_id){

        $brand = brand::find($brand_id);

        if(!$brand)
            return redirect()->route('Brands')->with(['error'=>'هذا القسم غير موجود']);

        return view('admin.brands.edit',compact('brand'));
    }

    public function update($cat_id, MainCategoryReq $request){
        // validation

        try {

            if (!$request->has('category.0.active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $category = Category::find($cat_id);

            if(!$category)
                return redirect()->route('main_categories')->with(['error'=> 'هذا القسم غير موجود']);

            $category -> update($request -> all());
            $category -> name = $request->name;
            $category->save();

            return redirect()->route('main_categories')->with(['success'=>'تم التحديث بنجاح']);
        }catch (Exception $exc){

            return redirect()->route('main_categories')->with(['error'=>'حدثت مشكلة ما حاول مرة اخري']);
        }

    }

    public function destroy($id){

        try {
            $category = Category::find($id);

            if(!$category)
                return redirect()->route('main_categories')->with(['error'=>'هذا القسم غير موجود']);

            $category -> delete();

            return redirect()->route('main_categories')->with(['success'=>'تم الحذف بنجاح']);
        }catch (Exception $exc){

            return redirect()->route('main_categories')->with(['error'=>'حدثت مشكلة ما حاول مرة اخري']);
        }
    }

    public function create(){

        //return response()->json([$categories]);

        return view('admin.brands.create');
    }

    public function store(BrandReq $request){

        try {
            DB::beginTransaction();

            if(!$request->has('ii_active'))
                $request->request->add(['is_active'=>0]);
            else
                $request->request->add(['is_active'=>1]);

            if($request->has('photo')){
                $fileName = saveImage($request->photo,'brands');
            }
            $brand = brand::created($request->except('_token','photo'));

            $brand->name = $request->name;
            $brand->photo = $fileName;
            $brand->save();

            return redirect()->route('Brands')->with(['success'=>'تم الاضافه بنجاح']);

            DB::commit();
        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('Brands')->with(['error'=>'حدث خطا ما']);

        }

        //return $request;

    }
}
