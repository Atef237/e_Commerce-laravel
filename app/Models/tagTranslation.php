<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class tagTranslation extends Model
{
    protected $fillable = [
        'name',
        'tag_id',
        'locale',
    ];

    public $timestamps = false;

}
