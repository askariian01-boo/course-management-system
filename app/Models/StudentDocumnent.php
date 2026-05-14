<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDocumnent extends Model
{
    protected $table = 'student_document';
    protected $fillable =[
        'student_id',
        'document_name',
        'document_file',
        'uploade_date',
    ];


    public function student(){
        return $this->belongsTo(Student::class);
    }
}
