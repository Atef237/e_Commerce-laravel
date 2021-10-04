<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $data = [];

        $data['slides'] = Slide::get(['photo']);
        $data['categories'] = Category::parent()->select('id','slug')->with(['childrens' => function($quire){
            $quire->select('id','parent_id','slug');
            $quire->with(['childrens'=>function($quiree){
                $quiree->select('id','parent_id','slug');
            }]);
        }])->get();

        // return $data;

        return view('front.home',$data);
    }
}
