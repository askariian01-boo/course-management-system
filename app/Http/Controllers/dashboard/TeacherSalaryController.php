<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TeacherSalary;
use App\Models\Teacher;


class TeacherSalaryController extends Controller
{
    public function salary_list(Request $request)
    {
        $year = $request->year ?? now()->year;
        $month = $request->month ?? now()->month;

        $salaries = TeacherSalary::with('teacher')
            ->where('salary_year', $year)
            ->where('salary_month', $month)
            ->orderBy('salary_year', 'desc')
            ->orderBy('salary_month', 'desc')
            ->get();

        return view('dashboard.teachers.teacher_salary.teacher_salary_list', [
            'salaries' => $salaries,
            'year' => $year,
            'month' => $month,
        ]);
    }


    public function payment_list(Request $request)
    {
        $query = TeacherSalary::with('Teacher');

        if ($request->filled('search')) {
            $query->whereHas('Teacher', function ($q) use ($request) {
                $q->where('FirstName', 'like', '%' . $request->search . '%')
                    ->orWhere('LastName', 'like', '%' . $request->search . '%')
                    ->orWhere('FatherName', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('year')) {
            $query->where('salary_year', $request->year);
        }

        $salaries = $query->paginate(10);
        $Teachers = Teacher::all();

        return view('dashboard.Teachers.Teacher_salary.Teacher_salary_payment', compact('salaries', 'Teachers'));
    }


    public function getAbsentDays($Teacher_id, $year, $month)
    {
        $absentDays = \App\Models\TeacherAttendance::where('Teacher_id', $Teacher_id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'absent')
            ->count();

        $Teacher = \App\Models\Teacher::find($Teacher_id);
        $grossSalary = $Teacher->GrossSalary ?? 0;
        $dailyRate = $grossSalary / 30;
        $absentAmount = $absentDays * $dailyRate;

        return response()->json([
            'absent_days' => $absentDays,
            'absent_amount' => round($absentAmount),
        ]);
    }


    // فرم افزودن
    public function salary_add()
    {
        $Teachers = Teacher::all();
        return view('dashboard.Teachers.Teacher_salary.Teacher_salary_add', compact('Teachers'));
    }

    // ذخیره معاش جدید
    public function salary_save(Request $request)
    {
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'salary_year' => 'required|integer',
            'salary_month' => 'required|integer|min:1|max:12',
            'absent_days' => 'nullable|integer|min:0',
            'absent_amount' => 'nullable|integer|min:0',
            'pay_date' => 'nullable|date',
        ]);

        $teacher = Teacher::findOrFail($request->teacher_id);

        // معاش اصلی از جدول Teacher
        $gross = $teacher->Gross_Salary;

        // محاسبات
        $gross = $teacher->GrossSalary; // از جدول Teacher
        $absent_days = $request->absent_days;
        $daily_salary = $gross / 30; // فرض: حقوق ماهانه / 30 روز
        $absent_amount = $absent_days * $daily_salary;
        $payable_salary = $gross - $absent_amount;

        $net_salary = max(0, $gross - $absent_amount);

        TeacherSalary::create([
            'teacher_id' => $teacher->id,
            'salary_year' => $request->salary_year,
            'salary_month' => $request->salary_month,
            'absent_days' => $absent_days,
            'absent_amount' => $absent_amount,
            'payable_salary' => $payable_salary,
            'net_salary' => $net_salary,
            'status' => 'unpaid',
            'pay_date' => $request->pay_date ?? now(),
        ]);

        $notification = array(
            'message' => 'teacher salary successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('teacher_salary_list')->with($notification);
    }

    public function salary_destroy($teacher_id, $year, $month)
    {
        TeacherSalary::where('Teacher_id', $teacher_id)
            ->where('salary_year', $year)
            ->where('salary_month', $month)
            ->delete();

        $notification = array(
            'message' => 'teaher salary successfuly deleted !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function markPaid($teacher_id, $salary_year, $salary_month)
    {
        TeacherSalary::where('Teacher_id', $teacher_id)
            ->where('salary_year', $salary_year)
            ->where('salary_month', $salary_month)
            ->update(['status' => 'paid']);

        $notification = array(
            'message' => 'teacher salary successfuly paid !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
