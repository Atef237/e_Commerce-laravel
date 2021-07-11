<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\generalProductRequest;
use App\Models\brand;
use App\Models\Category;
use App\Models\tag;
use Illuminate\Http\Request;

class productController extends Controller
{
    public function index(){

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

}