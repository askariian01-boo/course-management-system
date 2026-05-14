<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncomeSource extends Model
{
    protected $fillable = ['source_name'];
    protected $table = 'income_source';
    public function Income(){
        return $this->hasMany(Income::class);
    }
}
