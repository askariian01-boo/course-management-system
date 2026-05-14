<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\score;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function ScoreList(Request $request)
    {
        $query = score::with(['student', 'class', 'subject']);
        // فلتر صنف
        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }
        // فلتر مضمون
        if ($request->filled('subject_id')) {
            $query->where('subject_id', $request->subject_id);
        }
        // فلتر سال
        if ($request->filled('year')) {
            $query->where('exam_year', $request->year);
        }
        // گرفتن دیتا
        $scores = $query->latest()->get();

        $class = Classes::all();
        $subjects = Subject::all();

        return view('dashboard.scores.score_list', compact('scores', 'class', 'subjects'));
    }


    public function ScoreAdd()
    {
        $students = Student::all();
        $subjects = Subject::all();
        $class = Classes::all();

        return view('dashboard.scores.score_add', compact('students', 'subjects', 'class'));
    }


    public function getClassData($id)
    {
        $students = Student::where('class_id', $id)->get();

        $class = Classes::findOrFail($id);
        $subjects = $class->subjects;

        return response()->json([
            'students' => $students,
            'subjects' => $subjects
        ]);
    }


    public function ScoreSave(Request $request)
    {
        // validation
        $request->validate([
            'class_id' => ['required', 'exists:classes,id'],
            'student_id' => ['required', 'exists:students,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'exam_year' => ['required', 'integer', 'digits:4', 'min:2000', 'max:2050'],
            'first_chance' => ['required', 'numeric', 'min:0', 'max:100'],
            'second_chance' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        // جیلوگیری از ذخیره تکراری نمره باری یک شاگرد
        $exists = score::where('student_id', $request->student_id)
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->where('exam_year', $request->input('exam_year'))
            ->exists();

        if ($exists) {
            $notification = [
                'message' => 'This score has already been recorded.',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }

        //  ذخیره
        score::create([
            'class_id' => $request->class_id,
            'student_id' => $request->student_id,
            'subject_id' => $request->subject_id,
            'exam_year' => $request->input('exam_year'),
            'first_chance' => $request->first_chance,
            'second_chance' => $request->second_chance,
        ]);

        $notification = array(
            'message' => 'Score successfuly Created',
            'alert-type' => 'success'
        );
        return redirect()->route('score_list')->with($notification);
    }


    public function ScoreEdit($id)
    {
        $students = Student::all();
        $subjects = Subject::all();
        $class = Classes::all();
        $scores = score::findOrFail($id);

        return view('dashboard.scores.score_edit', compact('students', 'subjects', 'class', 'scores'));
    }


    public function ScoreUpdate(Request $request, $id)
    {
        $score = score::findOrFail($id);

        $request->validate([
            'class_id' => ['required', 'exists:classes,id'],
            'student_id' => ['required', 'exists:students,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'exam_year' => ['required', 'integer', 'digits:4', 'min:2000', 'max:2050'],
            'first_chance' => ['required', 'numeric', 'min:0', 'max:100'],
            'second_chance' => ['nullable', 'numeric', 'min:0', 'max:100'],
        ]);

        // جلوگیری از تکرار (به‌جز همین رکورد)
        $exists = score::where('student_id', $request->student_id)
            ->where('class_id', $request->class_id)
            ->where('subject_id', $request->subject_id)
            ->where('exam_year', $request->exam_year)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            $notification = [
                'message' => 'This score already exists for this student!',
                'alert-type' => 'error'
            ];
            return back()->with($notification);
        }

        $score->student_id = $request->student_id;
        $score->subject_id = $request->subject_id;
        $score->class_id = $request->class_id;
        $score->exam_year = $request->exam_year;
        $score->first_chance = $request->first_chance;
        $score->second_chance = $request->second_chance;
        $score->save();


        $notification = array(
            'message' => 'Score successfuly updated',
            'alert-type' => 'success'
        );
        return redirect()->route('score_list')->with($notification);
    }


    public function ScoreDelete($id){
        $score = score::findOrFail($id);
        $score->delete();
        $notification = array(
            'message' => 'Score successfuly deleted',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
