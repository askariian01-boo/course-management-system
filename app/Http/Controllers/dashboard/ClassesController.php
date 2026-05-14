<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function index(){
        $classes = Classes::all();
        return view('dashboard.classes.class_list')->with('classes' , $classes);
    }


    public function ClassAdd(){
        return view ('dashboard.classes.class_add');
    }


    public function ClassSave(Request $request){
        $data = $request->validate([
            'ClassName' => ['required', 'string', 'max:50'],
            'ClassFees' => ['required', 'numeric'],
        ]);

        // dd($data);

        $data = Classes::create([
            'ClassName' => $request->ClassName,
            'ClassFees' => $request->ClassFees,
        ]);

        $notification = array(
            'message' => 'class successfuly created !',
            'alert-type' => 'success'
         );
    return redirect()->route('classes')->with($notification);
    }


    public function ClassEdit($id){
        $class = Classes::find($id);
        return view('dashboard.classes.class_edit')->with('class' , $class);
    }


    public function ClassUpdate(Request $request , $id){
        $class = Classes::find($id);
        $request->validate([
            'ClassName' => ['required', 'string', 'max:50'],
            'ClassFees' => ['required', 'numeric'],
        ]);

        $class->ClassName = $request->ClassName;
        $class->ClassFees = $request->ClassFees;
        $class->save();

        $notification = array(
            'message' => 'class successfuly updated !',
            'alert-type' => 'success'
         );
    return redirect()->route('classes')->with($notification);
    }


    public function ClassDelete($id){
        $class = Classes::find($id);
        $class->delete();

        $notification = array(
            'message' => 'class successfuly deleted !',
            'alert-type' => 'success'
         );
    return redirect()->back()->with($notification);
    }


    // class student list
    public function StudentList($id){
        $class = Classes::with('students')->findOrFail($id);
        $students = $class->students;
        return view('dashboard.classes.student_list', compact('class', 'students'));
    }
}
