<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::all();
        return view('dashboard.subjects.subject_list')->with('subjects', $subjects);
    }

    public function SubjectDetail($id)
    {
        $subject = Subject::find($id);
        return view('dashboard.subjects.subject_detail')->with('subject', $subject);
    }


    public function SubjectAdd()
    {


        return view('dashboard.subjects.subject_add');
    }


    public function SubjectSave(Request $request)
    {
        $data = $request->validate([
            'SubjectName' => ['required', 'string', 'max:50'],
            'Author' => ['string'],
        ]);

        $subject = Subject::create([
            'SubjectName' => $request->SubjectName,
            'Author' => $request->Author,
        ]);

        $notification = array(
            'message' => 'subject successfuly created !',
            'alert-type' => 'success'
        );

        return redirect()->route('subjects')->with($notification);
    }



    public function SubjectEdit($id)
    {
        $subject = Subject::find($id);

        return view('dashboard.subjects.subject_edit')
            ->with('subject', $subject);
    }


    public function SubjectUpdate(Request $request, $id)
    {
        $subject = Subject::find($id);

        $data = $request->validate([
            'SubjectName' => ['required', 'string', 'max:50'],
            'Author' => ['string'],
        ]);

        $subject->SubjectName = $request->SubjectName;
        $subject->Author = $request->Author;
        $subject->save();

        $notification = array(
            'message' => 'subject successfuly updated !',
            'alert-type' => 'success'
        );

        return redirect()->route('subjects')->with($notification);
    }


    public function SubjectDelete($id)
    {
        $subject = Subject::find($id);
        $subject->delete();

        $notification = array(
            'message' => 'subject successfuly deleted !',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }


    // assign teacher to subject
    public function AssignTeacher($id)
    {
        $subject = Subject::findOrFail($id);
        $teachers = Teacher::all();
        return view('dashboard.subjects.teacher_subject_add')->with('teachers', $teachers)->with('subject', $subject);
    }


    public function SaveAssignTeacher(Request $request)
    {
        $data = $request->validate([
            'subject_id' => ['required', 'numeric'],
            'teacher_id' => ['required', 'array'],
            'teacher_id.*' => ['numeric'],
        ]);

        $subject = Subject::findOrFail($data['subject_id']);
        $subject->teachers()->sync($data['teacher_id'] ?? []);
        $notification = array(
            'message' => 'teacher asigned to subject successfuly !',
            'alert-type' => 'success'
        );
        return redirect()->route('subject_detail', $subject->id)->with($notification);
    }


    public function DeleteAssignTeacher($subject_id, $teacher_id)
    {
        $subject = Subject::findOrFail($subject_id);

        $subject->teachers()->detach($teacher_id);

        $notification = array(
            'message' => 'teacher removed from subject successfuly !',
            'alert-type' => 'success'
        );
        return redirect()->route('subject_detail', $subject->id)->with($notification);
    }
}
