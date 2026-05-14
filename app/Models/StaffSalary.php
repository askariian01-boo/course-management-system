<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffSalary extends Model
{
     protected $fillable = [
        'staff_id',
        'salary_year',
        'salary_days',
        'salary_month',
        'absent_amount',
        'payable_salary',
        'net_salary',
        'status',
        'pay_date',
    ];

    // protected $incrementing = false;

    protected $primaryKey = 'staff_id , salary_year , salary_month';

    public $timestamps = false;

    protected $table = 'staff_salary';

    public function Staff(){
        return $this->belongsTo(Staff::class);
    }
}
