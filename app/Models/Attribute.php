<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use Translatable;
    protected $with = ['translations'];

    protected $fillable = ['name','updated_at','created_at'];

    protected $translatedAttributes = ['name'];

}
