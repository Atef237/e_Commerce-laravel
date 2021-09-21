<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users_verfication extends Model
{
    public $table = 'users_verfication';

    protected $fillable = [
        'user_id',
        'pin_code',
        'created_at',
        'updated_at'
    ];


}
