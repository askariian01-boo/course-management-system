<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
     protected $fillable = [
        'staff_id',
        'attendance_date',
        'status',
        'remark',
    ];

    protected $primaryKey = 'staff_id , attendance_date';

    public $timestamps = false;

    protected $table = 'staff_attendance';

    public function Staff(){
        return $this->belongsTo(Staff::class);
    }
}
