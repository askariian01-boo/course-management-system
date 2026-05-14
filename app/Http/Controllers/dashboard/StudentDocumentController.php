<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\StudentDocumnent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentDocumentController extends Controller
{
    public function StudentDocuments(){
        $document = StudentDocumnent::all();
        return view('dashboard.students.student_documents.student_documents')->with('documents' , $document);
    }


    public function DocumentAdd(){
        $student = Student::all();
        return view('dashboard.students.student_documents.student_document_add')->with('students' , $student);
    }


    public function DocumentSave(Request $request){
    $data = $request->validate([
        'document_name' => ['required', 'string', 'max:255'],
        'document_file' => ['required', 'file'], 
        'uploade_date' => ['required', 'date'],
        'student_id' => ['required', 'integer'],
    ]);

    // ذخیره فایل در مسیر public/files/Staff_documents
    $document_file = $request->file('document_file');
    $filename = time() . '-' . $document_file->getClientOriginalName();
    $document_file->move(public_path('files/Student_documents'), $filename);

    // ذخیره اطلاعات در دیتابیس
    StudentDocumnent::create([
        'document_name' => $request->document_name,
        'uploade_date' => $request->uploade_date,
        'student_id' => $request->student_id,
        'document_file' => $filename 
    ]);

         $notification = array(
            'message' => 'student document successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('student_document')->with($notification);
    }


    public function download($filename){
        // مسیر کامل فایل در public
        $path = public_path('files/student_documents/' . $filename);
        // بررسی وجود فایل
        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'Not Found !');
        }
        // دانلود فایل
        return response()->download($path);
    }


    public function DocumentEdit($id){
        $student = Student::all();
        $document = StudentDocumnent::find($id);

        return view('dashboard.students.student_documents.student_document_edit')->with('students' , $student)->with('document' , $document);
    }


    public function DocumentUpdate(Request $request , $id){
        $document = StudentDocumnent::find($id);
        // dd($document);
        $data = $request->validate([
        'document_name' => ['required', 'string', 'max:255'],
        'uploade_date' => ['required', 'date'],
        'student_id' => ['required', 'integer'],
    ]);

    if(!is_null($request->document_file)){
           $request->validate([
                'document_file' => ['required' , 'file'],
            ]);
        }
    // dd($request->all());
    $document->student_id = $request->student_id;
    $document->document_name = $request->document_name;
    $document->uploade_date = $request->uploade_date;

    $document_file = $request->file('document_file');
    if($document_file){
        $filename = time() .'-'. $document_file->getClientOriginalName();
        $document_file->move(public_path('files/student_documents') . $filename);
            
        $document->document_file = $filename;
    }
    $document->save();
    $notification = array(
            'message' => 'student document successfuly updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('student_document')->with($notification);
    }


    public function DocumentDelete($id){
        $document = StudentDocumnent::find($id);
                //پیدا کردن عکس 
                $path = public_path('files/student_documents').'/'.$document->document_file;
                //وجود داشتن عکس
                if(File::exists($path)){
                    File::delete($path);
                    $document->delete();
                }
                $notification = array(
            'message' => 'student successfuly deleted !',
            'alert-type' => 'success'
        );
        return redirect()->route('student_document')->with($notification);
    }
}
