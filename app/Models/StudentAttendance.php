<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    protected $table = 'student_attendance';
    public $timestamps = false;
    protected $primaryKey = 'student_id , attendance_date';
    protected $fillable = [
        'student_id',
        'attendance_date',
        'status',
        'remark',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
