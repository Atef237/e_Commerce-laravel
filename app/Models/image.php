<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class image extends Model
{
    protected $fillable = ['product_id','photo','created_at','updated_at'];
}
