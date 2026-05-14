<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffDocument extends Model
{
    protected $fillable = [
        'staff_id',
        'document_name',
        'document_file',
        'uplode_date',
    ];

    public $timestamps = false;

    protected $table = 'staff_document';


    public function Staff(){
        return $this->belongsTo(Staff::class);
    }
}
