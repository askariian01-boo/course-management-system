<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{

    public function attendance_list(Request $request)
    {

        $year = request('year', now()->year);
        $month = request('month', now()->month);

        $Students = Student::withCount(['Attendances as absent_days' => function ($q) use ($year, $month) {
            $q->where('status', 'absent')
                ->whereYear('attendance_date', $year)
                ->whereMonth('attendance_date', $month);
        }])->get();

        return view('dashboard.Students.Student_attendance.Student_attendance_list')->with('Student_attendance', $Students);
    }


    public function attendance_add()
    {
        $Student = Student::all();
        return view('dashboard.students.Student_attendance.Student_attendance_add')->with('Students', $Student);
    }


    public function attendance_detail(Request $request, $id)
    {
        $year = $request->year ?? now()->year;
        $month = $request->month ?? now()->month;

        $attendances = StudentAttendance::where('Student_id', $id)
            ->whereYear('attendance_date', $year)
            ->whereMonth('attendance_date', $month)
            ->get()
            ->keyBy('attendance_date'); // key => date

        $Student = Student::findOrFail($id);
        return view('dashboard.Students.Student_attendance.Student_attendance_detail', compact('attendances', 'year', 'month', 'Student'));
    }

    public function attendance_save(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'attendance' => 'required|array',
        ]);

        foreach ($request->attendance as $StudentId => $status) {

            // فقط اگر غایب بود ادامه بده
            if ($status !== 'absent') {
                continue;
            }

            // جلوگیری از ثبت تکراری
            $exists = StudentAttendance::where('Student_id', $StudentId)
                ->where('attendance_date', $request->date)
                ->exists();

            if (!$exists) {
                StudentAttendance::create([
                    'student_id' => $StudentId,
                    'attendance_date' => $request->date,
                    'status' => 'absent',
                    'remark' => $request->remark[$StudentId] ?? null,
                ]);
            }
        }

        $notification = [
            'message' => 'Only absent Student saved successfully!',
            'alert-type' => 'success'
        ];

        return redirect()->route('tudent_attendance_list')->with($notification);
    }


    public function attendance_delete($Student_id, $date)
    {
        StudentAttendance::where('Student_id', $Student_id)
            ->where('attendance_date', $date)
            ->delete();

        return redirect()->back()->with([
            'message' => 'Attendance deleted successfully!',
            'alert-type' => 'success'
        ]);
    }
}
