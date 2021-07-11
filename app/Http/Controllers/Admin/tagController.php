<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\tagRequest;
use App\Models\tag;
use App\Models\tagTranslation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Utils;

class tagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = tag::orderBy('id','DESC')->paginate(pagination_count);
        return view('admin.tags.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(tagRequest $request)
    {

        //return $request;
        DB::beginTransaction();
            $tag = tag::create(['slug' => $request->slug]);
             $tag->name = $request->name;
             $tag->save();

         DB::commit();

            return redirect()->route('tags')->with(['success'=>'تم الاضافة بنجاح']);

        DB::rollBack();
            return redirect()->route('tags')->with(['error'=>'حدث خطأ ما حاول في وقت لاحق']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
//    public function show($id)
//    {
//        //
//    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = tag::find($id);
        return view('admin.tags.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(tagRequest $request, $id)
    {
        DB::beginTransaction();
            $tag = tag::find($id);
            if(!$tag){
                return redirect()->route('tags')->with(['error'=>'حدث خطأ ما حاول في وقت لاحق']);
            }

            $tag->update(['slug'=>$request->slug]);
            $tag->name = $request->name;
            $tag->save();

        DB::commit();
            return redirect()->route('tags')->with(['success'=>'تم الاضافة بنجاح']);

        DB::rollBack();
            return redirect()->route('tags')->with(['error'=>'حدث خطأ ما حاول في وقت لاحق']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
            $tag = tag::find($id);
            //$tag_translation = tagTranslation::where('tag_id',$id)->get();
            if(!$tag ){
                return redirect()->route('tags')->with(['error'=>'حدث خطأ ما حاول في وقت لاحق']);
            }
            $tag->delete();
            //$tag_translation->delete();
        DB::commit();
            return redirect()->route('tags')->with(['success'=>'تم الجذف بنجاح']);

        DB::rollBack();
            return redirect()->route('tags')->with(['error'=>'حدث خطأ ما حاول في وقت لاحق']);

    }
}
