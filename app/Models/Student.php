<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'FirstName',
        'LastName',
        'FatherName',
        'Gender',
        'MaritalStatus',
        'BirthDay',
        'NIC',
        'Phone',
        'Address',
        'Image',
        'RegDate',
        'class_id',
    ];

    public function attendances(){
        return $this->hasMany(StudentAttendance::class);
    }

    public function documents(){
        return $this->hasMany(StudentDocumnent::class);
    }

    public function feeses(){
        return $this->hasMany(StudentFees::class);
    }

    public function class(){
        return $this->belongsTo(Classes::class , 'class_id');
    }


    public function Scores(){
        return $this->hasMany(score::class , 'student_id');
    }
}
