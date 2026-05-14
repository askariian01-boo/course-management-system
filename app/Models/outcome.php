<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class outcome extends Model
{
    protected $fillable = [
        'id',
        'source_id',
        'outcome_amount',
        'outcome_date',
        'remark'
    ];

    protected $table = 'outcome';
 

    public function source()
    {
        return $this->belongsTo(outcome_source::class, 'source_id');
    }
}
