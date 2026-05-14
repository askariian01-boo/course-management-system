<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    protected $fillable = [
        'teacher_id',
        'attendance_date',
        'status',
        'remark',
    ];

    public $timestamps = false;

    protected $primaryKey = 'teacher_id , attendance_date';

    protected $table = 'teacher_attendance';


    public function Teacher (){
        return $this->belongsTo(Teacher::class);
    }
}
