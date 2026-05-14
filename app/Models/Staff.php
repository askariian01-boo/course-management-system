<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'user_id',
        'FirstName',
        'LastName',
        'FatherName',
        'Gender',
        'Image',
        'NIC',
        'phone',
        'Email',
        'Position',
        'Address',
        'GrossSalary',
        'RegDate',
    ];

    protected $table = 'staff';

    public function User()
    {
        return $this->belongsTo(User::class);
    }

    public function Salaries()
    {
        return $this->hasMany(StaffSalary::class);
    }

    public function Attendances()
    {
        return $this->hasMany(StaffAttendance::class, 'staff_id');
    }

    public function Documents()
    {
        return $this->hasMany(StaffDocument::class);
    }

}
