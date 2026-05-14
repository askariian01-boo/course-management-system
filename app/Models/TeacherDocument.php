<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherDocument extends Model
{
    protected $fillable = [
        'teacher_id',
        'document_name',
        'document_file',
        'uploade_date',
    ];

    public $timestamps = false;

    protected $table = 'teacher_document';


    public function Teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
