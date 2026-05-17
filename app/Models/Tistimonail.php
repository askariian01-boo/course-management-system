<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tistimonail extends Model
{
    protected $table = 'tistimonial';
    
    protected $fillable = [
        'name',
        'position',
        'message',
        'reting',
        'image',
    ];
}
