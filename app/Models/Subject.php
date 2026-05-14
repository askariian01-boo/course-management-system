<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'Author',
        'SubjectName',
    ];

    protected $table = 'subjects';


    public function classes(){
        return $this->belongsToMany(Classes::class , 'class_subject' , 'subject_id' , 'class_id');
    }


    public function Scores(){
        return $this->hasMany(score::class , 'subject_id');
    }


    public function Timetable(){
        return $this->hasMany(Timetable::class);
    }

}
