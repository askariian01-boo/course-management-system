<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = [
        'ClassName',
        'ClassFees',
    ];

    protected $table = 'classes';

    public function subjects(){
        return $this->belongsToMany(Subject::class , 'class_subject' , 'class_id' , 'subject_id');
    }

    public function students(){
        return $this->hasMany(Student::class , 'class_id');
    }

    public function teachers(){
        return $this->belongsToMany(Teacher::class , 'teacher_classes' , 'class_id' , 'teacher_id');
    }


    public function Scores(){
        return $this->hasMany(score::class , 'class_id');
    }


    public function Timetable(){
        return $this->hasMany(Timetable::class);
    }
}
