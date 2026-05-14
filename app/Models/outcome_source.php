<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class outcome_source extends Model
{
    protected $fillable = ['id' , 'source_name'];

    protected $table = 'outcome_source';


    public function Outcomes(){
        return $this->hasMany(outcome::class);
    }
}
 