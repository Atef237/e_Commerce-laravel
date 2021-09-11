<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use App\Rules\productQty;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;

class OptionController extends Controller
{
    // crud =>  create / retrieve / update / destroy

    public function index(){
        $optins = Option::with(['producte'=>function($prod){
            $prod->select('id');
        },'attribute' => function($attr){
            $attr->select('id');
        }])->select('id','product_id','attribute_id','price')->paginate(pagination_count);

        return view('admin.options.index',compact('optins'));
        //return $optins;
    }


    public function create(){
        $data = [];
        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();

        return view('admin.options.create',$data);
    }

    public function store(OptionRequest $request){

        //return $request;

        $option = Option::create([
            'price' => $request->price,
            'product_id' => $request->product_id,
            'attribute_id' => $request->attribute_id,
        ]);
        $option->name = $request->name;   // add in translations table
        $option->save();

        return redirect()->route('options')->with(['success' => 'تم الاضافة']);

    }

    public function edit($id){

        $data = [];

        $data['option'] = Option::find($id);

        if(!$data['option'])
            return view('admin.options.index')->with(['success'=>'هذا العنصر غير موجود']);

        $data['products'] = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();
        return view('admin.options.edit',$data);

    }

    public function update(OptionRequest $request, $id){


        //return $request;
        $option = Option::find($id);
        if(!$option)
            return view('admin.options.index')->with(['success' => 'هذا العنصر غير موجود']);


        //$option -> update($request->except(['token','id']));  // update method

        $option -> update($request->only(['name','price','product_id','attribute_id']));
        $option->name = $request->name;
        $option -> save();

        return redirect()->route('options')->with(['success' => 'تم التحديث بنجاح']);
    }


}
