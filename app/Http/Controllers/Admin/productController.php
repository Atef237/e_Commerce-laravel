<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\generalProductRequest;
use App\Http\Requests\ProductPriceValidation;
use App\Models\brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\tag;
use Illuminate\Http\Request;
use function PHPUnit\Framework\assertContainsOnly;
use function PHPUnit\Framework\returnArgument;

class productController extends Controller
{
    public function index(){

        $products = Product::select('id','slug','price','created_at')->paginate(pagination_count);
        return view('admin.product.general.index',compact('products'));
    }


    public function create(){
        $data = [];

        $data ['categories'] = Category::select('id')->Actev()->get();
        $data ['tags'] = tag::select('id')->get();
        $data ['brands'] = brand::select('id')->Actev()->get();
        //return $data;

        return view('admin.product.general.create',$data);
    }



    public function store(generalProductRequest $request){

        return $request;

    }

    public function edit(){

    }

    public function update(){

    }

    public function getPrice($id){

        //$product = Product::where('id',$id)->get();

        return view('admin.product.price.create')->with('id',$id);

    }


    public function storePrice(ProductPriceValidation $request){

        Product::whereId($request->product_id)->update($request->only(['price','special_price','special_price_type','special_price_start','special_price_end']));

        return redirect()->route('products')->with(['success'=>'تم التحديث بنجاح']);
    }


}
