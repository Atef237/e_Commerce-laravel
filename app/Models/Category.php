<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;


class Category extends Model
{
    use Translatable;

    protected $with = ['translations'];

    protected $translatedAttributes = ['name'];

    protected $fillable = ['parent_id','is_active','slug'];

    protected $hidden = ['translation'];

    protected $casts = [

        'is_active' => 'boolean'
    ];

    public function scopeParent($query){
        return $query -> where('parent_id',null);
    }

    public function scopeChiled($query){
        return $query -> whereNotNull('parent_id',null);
    }

    public function getActive(){
       return $this-> is_active == 0 ? 'غير مفعل' : 'مفعل' ;
    }

    public function parent_cat(){
        return $this -> belongsTo(self::class,'parent_id');
    }
}
