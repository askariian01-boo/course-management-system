<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassSubject extends Model
{
    protected $table = 'class_subject';

    protected $fillable = ['class_id', 'subject_id'];

    public function subjects()
    {
        return $this->belongsToMany(Subject::class,'class_subject','class_id','subject_id')->using(ClassSubject::class);
    }
}
