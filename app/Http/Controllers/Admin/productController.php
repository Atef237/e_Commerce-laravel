<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\generalProductRequest;
use App\Http\Requests\ProductImageRequest;
use App\Http\Requests\ProductInventoryRequest;
use App\Http\Requests\ProductPriceValidation;
use App\Models\brand;
use App\Models\Category;
use App\Models\image;
use App\Models\photos;
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

        // return $request;

        if (!$request->has('is_active'))
            $request->request->add(['is_active' => 0]);
        else
            $request->request->add(['is_active' => 1]);


        $product = Product::create([
            'slug' => $request->slug,
            'brand_id' => $request->brand_id,
            'is_active' => $request->is_active,
        ]);
        //save translations
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->save();

        return redirect()->route('products')->with(['success' => 'تم ألاضافة بنجاح']);



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


    public function addInventory($id){
        return view('admin.product.inventory.create')->with('id',$id);
    }

    public function storeInventory(ProductInventoryRequest $request){
        //return $request;
        Product::whereId($request -> product_id ) -> update($request -> except(['_token','product_id']));
        return redirect()->route('products')->with(['success'=>'تم التحديث بنجاح']);
    }

    public function addImage($id){
        return view('admin.product.images.create')->withId($id);
    }


    public function storeImage(Request $request){

        $file = $request->file('dzfile');
        $filename = saveImage($file,'product');

         return response()->json([
            'name' => $filename,
            'original_name' => $file->getClientOriginalName(),
         ]);

    }

    public function saveForm(ProductImageRequest $request){
         // return $request;

        if($request->has('documents') && count($request->documents)> 0){

            foreach ($request->documents as $document){
                photos::create([
                    'photoable_type' => 'App\Models\Product',
                    'photoable_id' => $request->product_id,
                    'photo' => $document,
                ]);
            }

        }

        return redirect()->route('products')->with(['success' => 'تم اضافة الصور بنجاح']);
    }

}
