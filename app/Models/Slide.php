<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable =[
        'created_at',
        'updated_at',
        'photo'
    ];

//    public function photos(){
//        return $this->morphMany(photos::class,'photoable');
//    }
}
