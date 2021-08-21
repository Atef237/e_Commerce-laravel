<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class photos extends Model
{
    protected $fillable = ['photoable_id','photoable_type','photo','created_at','updated_at'];

    public function photoable(){
        return $this->morphTo();
    }
}
