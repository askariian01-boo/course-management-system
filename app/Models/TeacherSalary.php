<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherSalary extends Model
{
    protected $fillable = [
        'teacher_id',
        'salary_year',
        'salary_month',
        'absent_days',
        'absent_amount',
        'payable_salary',
        'net_salary',
        'status',
        'pay_date',
    ];

    public $timestamps = false;
    
    protected $table = 'teacher_salary';

    protected $primaryKey = 'teahcer_id , salary_year , salary_month';

    public function Teacher(){
        return $this->belongsTo(Teacher::class);
    }
}
