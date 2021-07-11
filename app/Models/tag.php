<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    use Translatable;

    protected $with = ['translations'];

    protected $translatedAttributes = ['name']; // field name in translation table

    protected $fillable = ['slug'];

    public $timestamps = false;
}
