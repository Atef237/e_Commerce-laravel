<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
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

        //return $brand;

        if(!$brand)
            return redirect()->route('Brands')->with(['error'=>'هذا القسم غير موجود']);

        return view('admin.brands.edit',compact('brand'));
    }

    public function update($brand_id, BrandRequest $request){
        // validation

        if (!$request->has('brand.0.is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);

        try {
            DB::beginTransaction();
                $brand = brand::find($brand_id);

                if(!$brand)
                    return redirect()->route('Brands')->with(['error'=> 'هذا القسم غير موجود']);

                $filName = saveImage($request->photo,'brands');
                $brand -> update($request -> all());
                $brand -> name = $request->name;
                $brand->photo = $filName;
                $brand->save();
            DB::commit();

            return redirect()->route('Brands')->with(['success'=>'تم التحديث بنجاح']);

        }catch (Exception $exc){

            DB::rollBack();
            return redirect()->route('Brands')->with(['error'=>'حدثت مشكلة ما حاول مرة اخري']);
        }

    }

    public function destroy($id){

       // $brand= brand::find($id);

       // return $brand;
        try {
            $brand= brand::find($id);

            if(!$brand)
                return redirect()->route('Brands')->with(['error'=>'هذا القسم غير موجود']);

            //$file_path = app_path().'/images/brands/'.$brand->photo;
            //unlink($file_path);

            $brand -> delete();

            return redirect()->route('Brands')->with(['success'=>'تم الحذف بنجاح']);
        }catch (Exception $exc){

            return redirect()->route('Brands')->with(['error'=>'حدثت مشكلة ما حاول مرة اخري']);
        }
    }

    public function create(){

        //return response()->json([$categories]);

        return view('admin.brands.create');
    }

    public function store(Request $request){
        //return $request;


        try {

            DB::beginTransaction();
                if(!$request->has('is_active'))
                    $request->request->add(['is_active'=>0]);
                else
                    $request->request->add(['is_active'=>1]);

                if($request->has('photo')){
                    $fileName = saveImage($request->photo,'brands');
                }
                $brand = brand::create($request->except('_token','photo'));

                $brand->name = $request->name;
                $brand->photo = $fileName;
                $brand->save();
            DB::commit();

                return redirect()->route('Brands')->with(['success'=>'تم الاضافه بنجاح']);

        }catch (\Exception $ex){
            DB::rollBack();
            return redirect()->route('Brands')->with(['error'=>'حدث خطأ ما']);

        }



    }
}
