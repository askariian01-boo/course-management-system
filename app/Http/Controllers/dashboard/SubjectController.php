<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(){
        $subjects = Subject::all();
        return view('dashboard.subjects.subject_list')->with('subjects' , $subjects);
    }


    public function SubjectAdd(){

        
        return view('dashboard.subjects.subject_add');
    }


    public function SubjectSave(Request $request){
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



    public function SubjectEdit($id){
        $subject = Subject::find($id);

        return view('dashboard.subjects.subject_edit')
        ->with('subject' , $subject);
    }


    public function SubjectUpdate(Request $request , $id){
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


    public function SubjectDelete($id){
        $subject = Subject::find($id);
        $subject->delete();

        $notification = array(
            'message' => 'subject successfuly deleted !',
            'alert-type' => 'success'
         );

         return redirect()->back()->with($notification);
    }
}
