<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentFees extends Model
{
    protected $table = 'student_fees';
    public $timestamps = false;
    protected $fillable = [
        'student_id',
        'fees_year',
        'fees_month',
        'fees_amount',
        'payment_date',
    ];

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
