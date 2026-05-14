<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffSalary;
use Illuminate\Http\Request;

class StaffSalaryController extends Controller
{
    public function salary_list(Request $request)
    {
        $year = $request->year ?? now()->year;
        $month = $request->month ?? now()->month;

        $salaries = StaffSalary::with('staff')
            ->where('salary_year', $year)
            ->where('salary_month', $month)
            ->orderBy('salary_year', 'desc')
            ->orderBy('salary_month', 'desc')
            ->get();

        return view('dashboard.staff.staff_salary.staff_salary_list', [
            'salaries' => $salaries,
            'year' => $year,
            'month' => $month,
        ]);
    }


    public function payment_list(Request $request)
    {
        $query = StaffSalary::with('staff');

        if ($request->filled('search')) {
            $query->whereHas('staff', function ($q) use ($request) {
                $q->where('FirstName', 'like', '%' . $request->search . '%')
                    ->orWhere('LastName', 'like', '%' . $request->search . '%')
                    ->orWhere('FatherName', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('year')) {
            $query->where('salary_year', $request->year);
        }

        $salaries = $query->paginate(100);
        $staffs = Staff::all();

        return view('dashboard.staff.staff_salary.staff_salary_payment', compact('salaries', 'staffs'));
    }


    public function getAbsentDays($staff_id, $year, $month)
    {
        $absentDays = \App\Models\StaffAttendance::where('staff_id', $staff_id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->where('status', 'absent')
            ->count();

        $staff = \App\Models\Staff::find($staff_id);
        $grossSalary = $staff->GrossSalary ?? 0;
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
        $staffs = Staff::all();
        return view('dashboard.staff.staff_salary.staff_salary_add', compact('staffs'));
    }

    // ذخیره معاش جدید
    public function salary_save(Request $request)
    {
        $request->validate([
            'staff_id' => 'required|exists:staff,id',
            'salary_year' => 'required|integer',
            'salary_month' => 'required|integer|min:1|max:12',
            'absent_days' => 'nullable|integer|min:0',
            'absent_amount' => 'nullable|integer|min:0',
            'pay_date' => 'nullable|date',
        ]);

        $staff = Staff::findOrFail($request->staff_id);

        // معاش اصلی از جدول staff
        $gross = $staff->Gross_Salary;

        // محاسبات
        $gross = $staff->GrossSalary; // از جدول staff
        $absent_days = $request->absent_days;
        $daily_salary = $gross / 30; // فرض: حقوق ماهانه / 30 روز
        $absent_amount = $absent_days * $daily_salary;
        $payable_salary = $gross - $absent_amount;

        $net_salary = max(0, $gross - $absent_amount);

        StaffSalary::create([
            'staff_id' => $staff->id,
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
            'message' => 'staff salary successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('staff_salary_list')->with($notification);
    }

    public function salary_destroy($staff_id, $year, $month)
    {
        StaffSalary::where('staff_id', $staff_id)
            ->where('salary_year', $year)
            ->where('salary_month', $month)
            ->delete();

        $notification = array(
            'message' => 'satff salary successfuly delted !',
            'alert-type' => 'success'
        );
        return redirect()->route('staff_salary_list')->with($notification);
    }


    public function markPaid($staff_id, $salary_year, $salary_month)
    {
        StaffSalary::where('staff_id', $staff_id)
            ->where('salary_year', $salary_year)
            ->where('salary_month', $salary_month)
            ->update(['status' => 'paid']);

        $notification = array(
            'message' => 'staff salary successfuly paied !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
