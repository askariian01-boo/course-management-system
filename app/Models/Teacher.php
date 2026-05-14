<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
      protected $fillable = [
        'user_id',
        'FirstName',
        'LastName',
        'FatherName',
        'Gender',
        'MaritalStatus',
        'BirthDay',
        'Address',
        'Image',
        'Phone',
        'Email',
        'EducationDegree',
        'EducationUniversity',
        'EducationYear',
        'TalnetScore',
        'GrossSalary',
        'NIC',
        'RegDate',
    ];

    protected $table = 'teachers';

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Salaries(){
        return $this->hasMany(TeacherSalary::class);
    }

    public function Documents(){
        return $this->hasMany(TeacherDocument::class);
    }


    public function Attendances(){
        return $this->hasMany(TeacherAttendance::class);
    }


    public function Timetable(){
        return $this->hasMany(Timetable::class);
    }
}
