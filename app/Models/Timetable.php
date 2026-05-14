<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = ['weekday','period','class_id','subject_id','teacher_id'];
    protected $table = 'timetable';

    public function Teacher(){
        return $this->belongsTo(Teacher::class , 'teacher_id');
    }

    public function Subject(){
        return $this->belongsTo(Subject::class , 'subject_id');
    }

    public function Classes(){
        return $this->belongsTo(Classes::class , 'class_id');
    }
}
