<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\StaffAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class StaffAttendanceController extends Controller
{
    // لیست حاضری کارمندان
    public function attendance_list(Request $request)
    {

        $year = $request->year ?? now()->year;
        $month = $request->month ?? now()->month;

        $staffs = Staff::withCount(['Attendances as absent_days' => function ($q) use ($year, $month) {
            $q->where('status', 'absent')
                ->whereYear('attendance_date', $year)
                ->whereMonth('attendance_date', $month);
        }])->get();

        return view('dashboard.staff.staff_attendance.staff_attendance_list')->with('staff_attendance', $staffs);
    }


    // staff attendance detail
    public function attendance_detail(Request $request, $id)
    {
        $year = $request->year ?? now()->year;
        $month = $request->month ?? now()->month;

        $attendances = StaffAttendance::where('staff_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->get()
            ->keyBy('attendance_date'); // key => date

        $staff = Staff::findOrFail($id);

        return view('dashboard.staff.staff_attendance.staff_attendance_detail', compact('attendances', 'year', 'month', 'staff'));
    }


    // staff attendance add
    public function attendance_add()
    {
        $staff = Staff::all();
        return view('dashboard.staff.staff_attendance.staff_attendance_add')->with('staffs', $staff);
    }


    public function attendance_save(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $staffId => $status) {

            // فقط اگر غایب بود ادامه بده
            if ($status !== 'absent') {
                continue;
            }

            // جلوگیری از ثبت تکراری
            $exists = StaffAttendance::where('staff_id', $staffId)
                ->where('attendance_date', $request->date)
                ->exists();

            if (!$exists) {
                StaffAttendance::create([
                    'staff_id' => $staffId,
                    'attendance_date' => $request->date,
                    'status' => 'absent',
                    'remark' => $request->remark[$staffId] ?? null,
                ]);
            }
        }

        $notification = [
            'message' => 'Only absent staff saved successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('staff_attendance_list')->with($notification);
    }

    // staff attendance delete
    public function attendance_delete($staff_id, $date)
    {
        StaffAttendance::where('staff_id', $staff_id)
            ->where('attendance_date', $date)
            ->delete();

        return redirect()->back()->with([
            'message' => 'Attendance deleted successfully!',
            'alert-type' => 'success'
        ]);
    }
}
