<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $fillable = ['source_id','income_amount','income_date'];
    protected $table = 'income';
    public function IncomeSource(){
        return $this->belongsTo(IncomeSource::class , 'source_id');
    }
}
