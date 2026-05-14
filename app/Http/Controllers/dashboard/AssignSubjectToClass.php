<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class AssignSubjectToClass extends Controller
{


    public function AssignSubjectList($id){
    $class = Classes::with('subjects')->findOrFail($id);
    $subjects = $class->subjects;
    return view('dashboard.classes.assign_subject.assign_subject_list', compact('class', 'subjects'));
    }


    public function AssignSubject($id){
        $class = Classes::find($id);
        $subjects = Subject::all();
        return view('dashboard.classes.assign_subject.assign_subject')->with('class' , $class)->with('subjects' , $subjects);
    }


    public function SaveAssignSubject(Request $request){
    $data = $request->validate([
    'class_id' => ['required', 'numeric'],
    'subject_id' => ['required', 'array'],
    'subject_id.*' => ['numeric'],
    ]);

    $class = Classes::findOrFail($data['class_id']);
    $class->subjects()->sync($data['subject_id']); 
    $notification = array(
            'message' => 'subject asigned to class successfuly !',
            'alert-type' => 'success'
         );
    return redirect()->route('classes')->with($notification);
}

    public function DeleteAssignSubject($id){
        $subject = Subject::find($id);
        $subject->delete();

        $notification = array(
            'message' => 'subject deleted successfuly !',
            'alert-type' => 'success'
         );
    return redirect()->back()->with($notification);
    }

}
