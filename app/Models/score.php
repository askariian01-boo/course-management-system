<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class score extends Model
{
    protected $fillable = ['student_id','class_id','subject_id','exam_year','first_chance','second_chance'];
    protected $table = 'score';

    public function student(){
        return $this->belongsTo(Student::class , 'student_id');
    }

    public function subject(){
        return $this->belongsTo(Subject::class , 'subject_id');
    }

    public function class(){
        return $this->belongsTo(Classes::class , 'class_id');
    }
}
