<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentFees;
use Illuminate\Http\Request;

class StudentFeesController extends Controller
{

    // نمایش لیست شهریه‌ها
    public function fees_list(Request $request)
    {
        $query = StudentFees::with(['student.class']);

        // 🔍 جستجو (نام، تخلص، نام پدر)
        // if ($request->filled('search')) {
        //     $search = $request->search;

        //     $query->whereHas('student', function ($q) use ($search) {
        //         $q->where(function ($sub) use ($search) {
        //             $sub->where('FirstName', 'like', "%{$search}%")
        //                 ->orWhere('LastName', 'like', "%{$search}%")
        //                 ->orWhere('FatherName', 'like', "%{$search}%");
        //         });
        //     });
        // }

        // 📅 فیلتر سال
        if ($request->filled('year')) {
            $query->where('fees_year', $request->year);
        }

        // 📅 فیلتر ماه (این مهم بود که نداشتی)
        if ($request->filled('month')) {
            $query->where('fees_month', $request->month);
        }

        // 📊 مرتب‌سازی جدیدترین‌ها
        $fees = $query->paginate(1000)->withQueryString();

        return view('dashboard.students.student_fees.student_fees_list', compact('fees'));
    }


    public function getStudentFee($id)
    {
        $student = Student::with('class')->find($id);

        if (!$student || !$student->class) {
            return response()->json(['fee' => 0]);
        }

        return response()->json([
            'fee' => $student->class->ClassFees ?? 0
        ]);
    }


    // فرم ثبت شهریه
    public function fees_add()
    {
        $students = Student::all();
        return view('dashboard.students.student_fees.student_fees_add', compact('students'));
    }

    // ذخیره شهریه
    public function fees_save(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'fees_year' => 'required|integer',
            'fees_month' => 'required|integer|between:1,12',
            'fees_amount' => 'required|integer|min:0',
            'payment_date' => 'required|date',
        ]);

        // جلوگیری از ثبت تکراری
        StudentFees::updateOrCreate(
            [
                'student_id' => $request->student_id,
                'fees_year' => $request->fees_year,
                'fees_month' => $request->fees_month,
            ],
            [
                'fees_amount' => $request->fees_amount,
                'payment_date' => $request->payment_date,
            ]
        );

        $notification = array(
            'message' => 'student fees successfuly paid !',
            'alert-type' => 'success'
        );
        return redirect()->route('student_fees_list')->with($notification);
    }
}
