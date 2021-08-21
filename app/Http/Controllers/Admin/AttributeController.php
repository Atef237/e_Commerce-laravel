<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use Illuminate\Http\Request;

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

}
