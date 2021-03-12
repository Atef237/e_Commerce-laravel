<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class brand extends Model
{
    protected $with = ['translation'];

    protected $fillable = ['is_active','photo'];

    protected $casts = ['is_active' => 'boolean'];

    public $translatedAttributes = ['name'];



}
