<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    use Translatable;

    protected $with = ['translations'];

    protected $fillable = ['is_active','photo'];

    protected $casts = ['is_active' => 'boolean'];

    protected $translatedAttributes = ['name'];

    public function getActive(){
        return $this-> is_active == 0 ? 'غير مفعل' : 'مفعل' ;
    }

    public function getPhotoAttribute($photo){
        return($photo !== null) ? asset('assets/images/brands/'.$photo) : "";
    }

}
