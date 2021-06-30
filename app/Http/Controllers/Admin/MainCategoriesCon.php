<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Enumerations\categoryType;
use App\Http\Requests\MainCategoryReq;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use function GuzzleHttp\Promise\all;

class MainCategoriesCon extends Controller
{
    public function index(){

        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    public function edit($cat_id){

          $category = Category::find($cat_id);
         $selections = Category::select('id','parent_id')->get();

        if(!$category)
            return redirect()->route('main_categories')->with(['error'=>'هذا القسم غير موجود']);

        return view('admin.categories.edit',compact(['category','selections']));
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

        $selections = Category::select('id','parent_id')->get();
        return view('admin.categories.create',compact('selections'));
    }

    public function store(MainCategoryReq $request){

        //return $request;


           DB::beginTransaction();
                if (!$request->has('is_active'))
                    $request->request->add(['is_active' => 0]);
                else
                    $request->request->add(['is_active' => 1]);

//                if($request->is_parent == categoryType::mainCategory)
//                        $request->parent_id = null;



            $category = Category::create($request -> except('_token'));

                $category -> name = $request->name;
                $category -> parent_id = $request->parent_id;
                $category->save();

               return redirect()->route('main_categories')->with(['success'=>'تم الاضافة بنجاح']);
            DB::commit();


            DB::rollBack();
           return redirect()->route('main_categories')->with(['error'=>'حدث خطأ ما حاول في وقت لاحق']);


    }

}
