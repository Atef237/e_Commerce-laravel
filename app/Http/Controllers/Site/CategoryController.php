<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function productsBySlug($slug){

        $data =[];

        $data['slides'] = Slide::get(['photo']);
        $data['categories'] = Category::parent()->select('id','slug')->with(['childrens' => function($quire){
            $quire->select('id','parent_id','slug');
            $quire->with(['childrens'=>function($quiree){
                $quiree->select('id','parent_id','slug');
            }]);
        }])->get();

         $data['category'] = Category::where('slug',$slug)->first();
        if($data['category'])
              $data['products'] = $data['category']->makeVisible(['translations']) -> product()->with(['photos'=>function($quire){
                  $quire->select('photo');
              }])->get();

        // return $data['products']['0']['photos'];
        // $data['image'] = Product::find(11)->photos;
        //return $data['products'];

        return view('front.product',$data);
    }
}
