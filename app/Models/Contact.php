<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'mobile',
        'email',
        'office_address',
        'map',
        'watsapp',
        'telegram',
        'facebook',
    ];

    protected $table = 'contact';
}
