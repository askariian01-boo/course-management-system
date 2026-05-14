<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\TeacherAttendance;

class teacherAttendanceController extends Controller
{
    public function attendance_list(Request $request)
    {

        $year = request('year', now()->year);
        $month = request('month', now()->month);

        $teachers = Teacher::withCount(['Attendances as absent_days' => function ($q) use ($year, $month) {
            $q->where('status', 'absent')
                ->whereYear('attendance_date', $year)
                ->whereMonth('attendance_date', $month);
        }])->get();

        return view('dashboard.Teachers.Teacher_attendance.Teacher_attendance_list')->with('teacher_attendance', $teachers);
    }


    public function attendance_add()
    {
        $Teacher = Teacher::all();
        return view('dashboard.Teachers.Teacher_attendance.Teacher_attendance_add')->with('Teachers', $Teacher);
    }


    public function attendance_detail(Request $request, $id)
    {
        $year = $request->year ?? now()->year;
        $month = $request->month ?? now()->month;

        $attendances = TeacherAttendance::where('teacher_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->get()
            ->keyBy('attendance_date');// key => date

        $teacher = Teacher::findOrFail($id);

        return view('dashboard.teachers.teacher_attendance.teacher_attendance_detail', compact('attendances', 'year', 'month', 'teacher'));
    }

    public function attendance_save(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $teacherId => $status) {

            // فقط اگر غایب بود ادامه بده
            if ($status !== 'absent') {
                continue;
            }

            // جلوگیری از ثبت تکراری
            $exists = TeacherAttendance::where('teacher_id', $teacherId)
                ->where('attendance_date', $request->date)
                ->exists();

            if (!$exists) {
                TeacherAttendance::create([
                    'teacher_id' => $teacherId,
                    'attendance_date' => $request->date,
                    'status' => 'absent',
                    'remark' => $request->remark[$teacherId] ?? null,
                ]);
            }
        }

        $notification = [
            'message' => 'Only absent teacher saved successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('teacher_attendance_list')->with($notification);
    }


    public function attendance_delete($teacher_id, $date)
    {
        TeacherAttendance::where('teacher_id', $teacher_id)
            ->where('attendance_date', $date)
            ->delete();

        return redirect()->back()->with([
            'message' => 'Attendance deleted successfully!',
            'alert-type' => 'success'
        ]);
    }
}
