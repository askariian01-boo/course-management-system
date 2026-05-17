<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Timetable;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TimetableController extends Controller
{
    public function TimetableList(Request $request)
    {
        $classes = Classes::all();

        $timetables = [];

        if ($request->class_id) {
            $timetables = Timetable::with(['teacher', 'subject'])
                ->where('class_id', $request->class_id)
                ->get()
                ->groupBy('weekday');
        }
        return view('dashboard.timetable.timetable_list', compact('timetables', 'classes'));
    }


    // گرفتن مضامین همان صنف
    public function getSubjects($class_id)
    {
        $class = Classes::find($class_id);
        if (!$class) {
            return response()->json([]);
        }
        $subjects = $class->subjects;
        return response()->json($subjects);
    }
    // گرفتن استاد همان مضامین
    public function getTeachers($subject_id)
    {
        try {
            if (!$subject_id) {
                return response()->json([]);
            }

            $subject = Subject::with('teachers')->find($subject_id);

            if (!$subject) {
                return response()->json([]);
            }
            return response()->json($subject->teachers);
        } catch (\Exception $e) {

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function TimetableAdd()
    {
        $class = Classes::all();
        $teachers = Teacher::all();

        return view('dashboard.timetable.timetable_add', compact('class', 'teachers'));
    }

    public function TimetableSave(Request $request)
    {
        $request->validate([
            'weekday' => 'required|integer|between:1,6',
            'period' => 'required|integer|between:1,4',
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        // جلوگیری از تداخل صنف
        if (Timetable::where('weekday', $request->weekday)
            ->where('period', $request->period)
            ->where('class_id', $request->class_id)
            ->exists()
        ) {
            $notification = [
                'message' => 'This class is already assigned to this time slot',
                'alert-type' => 'error'
            ];

            return back()->with($notification);
        }

        // جلوگیری از تداخل استاد
        if (Timetable::where('weekday', $request->weekday)
            ->where('period', $request->period)
            ->where('teacher_id', $request->teacher_id)
            ->exists()
        ) {
            $notification = [
                'message' => 'This teacher is already assigned to this time slot',
                'alert-type' => 'error'
            ];

            return back()->with($notification);
        }

        Timetable::create([
            'weekday' => $request->weekday,
            'period' => $request->period,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'teacher_id' => $request->teacher_id,
            // برای این که ساعت باید ۱۲ ساعته باشد و با فرمت AM/PM نمایش داده شود، از Carbon استفاده می‌کنیم
            'start_time' => Carbon::createFromFormat('H:i', $request->start_time)->format('h:i A'),
            'end_time' => Carbon::createFromFormat('H:i', $request->end_time)->format('h:i A'),
        ]);

        $notification = [
            'message' => 'Timetable successfully created',
            'alert-type' => 'success'
        ];

        return redirect()->route('timetable_list')->with($notification);
    }


    public function TimetableEdit($id)
    {
        $class = Classes::all();
        $teachers = Teacher::all();
        $timetables = Timetable::findOrFail($id);

        return view('dashboard.timetable.timetable_edit', compact('class', 'teachers', 'timetables'));
    }



    public function TimetableUpdate(Request $request, $id)
    {
        $timetable = Timetable::findOrFail($id);
        $request->validate([
            'weekday' => 'required|integer|between:1,6',
            'period' => 'required|integer|between:1,4',
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
            'teacher_id' => 'required|exists:teachers,id',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $existsClass = Timetable::where('weekday', $request->weekday)
            ->where('period', $request->period)
            ->where('class_id', $request->class_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($existsClass) {
            $notification = [
                'message' => 'This class is already scheduled at this time',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }

        $existsTeacher = Timetable::where('weekday', $request->weekday)
            ->where('period', $request->period)
            ->where('teacher_id', $request->teacher_id)
            ->where('id', '!=', $id)
            ->exists();

        if ($existsTeacher) {
            $notification = [
                'message' => 'This teacher is already assigned to this time slot',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }


        $timetable->weekday = $request->weekday;
        $timetable->period = $request->period;
        $timetable->class_id = $request->class_id;
        $timetable->subject_id = $request->subject_id;
        $timetable->teacher_id = $request->teacher_id;
        $timetable->start_time = Carbon::createFromFormat('H:i', $request->start_time)->format('h:i A');
        $timetable->end_time = Carbon::createFromFormat('H:i', $request->end_time)->format('h:i A');

        $timetable->save();

        $notification = [
            'message' => 'Timetable successfully updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('timetable_list')->with($notification);
    }



    public function TimetableDelete($id)
    {
        $timetable = Timetable::findOrFail($id);
        $timetable->delete();

        $notification = [
            'message' => 'Timetable successfully deleted',
            'alert-type' => 'error'
        ];
        return back()->with($notification);
    }
}
