<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;


class Category extends Model
{
    use Translatable;

    // protected $with = ['translations'];

    protected $translatedAttributes = ['name'];

    protected $fillable = ['parent_id','is_active','slug'];

    protected $hidden = ['translations'];

    protected $casts = [

        'is_active' => 'boolean'
    ];

    public function photos(){
        return $this->morphTo(photos::class,'photoable');
    }

    public function scopeParent($query){
        return $query -> where('parent_id',null);
    }

    public function getActive(){
       return $this-> is_active == 0 ? 'غير مفعل' : 'مفعل' ;
    }

    public function scopeChiled($query){
        return $query -> whereNotNull('parent_id',null);
    }


    public function parent_cat(){
        return $this -> belongsTo(self::class,'parent_id');
    }

    public function scopeActev($request){
        return $this-> where('is_active',1);
    }

    public function childrens(){
        return $this->hasMany(self::class,'parent_id');
    }
}
