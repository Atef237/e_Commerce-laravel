<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\photos;
use App\Models\Slide;
use Illuminate\Http\Request;

class MainSlidController extends Controller
{
    public function index(){

    }

    public function create(){
         $slides = Slide::get(['photo']);
        return view('admin.slider.create',compact('slides'));
    }

    public function storeImage(Request $request){

        $file = $request->file('dzfile');
        $filename = saveImage($file,'slide');

        return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function store(Request $request)
    {
         // return $request;

        try {
            // save dropzone images
            if($request->has('documents') && count($request->documents)> 0) {

                foreach ($request->documents as $document) {

                    Slide::create([
                        'photo' => $document,
                    ]);
                }

            }

            return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
        }
    }
}
