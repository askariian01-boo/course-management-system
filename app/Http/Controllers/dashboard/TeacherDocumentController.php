<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\TeacherDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeacherDocumentController extends Controller
{
    public function index(){
        $documents = TeacherDocument::all();
        return view('dashboard.teachers.teacher_documents.teacher_documents')->with('documents' , $documents);
    }


    public function DocumentAdd(){
        $teachers = Teacher::all();
        return view('dashboard.teachers.teacher_documents.teacher_document_add')->with('teachers' , $teachers);
    }


    public function DocumentSave(Request $request){
        $data = $request->validate([
        'document_name' => ['required', 'string', 'max:255'],
        'document_file' => ['required', 'file'], 
        'uploade_date' => ['required', 'date'],
        'teacher_id' => ['required', 'integer'],
    ]);

    $document_file = $request->file('document_file');
    $filename = time() .'-'. $document_file->getClientOriginalName();
    $document_file->move(public_path('files/teacher_documents') , $filename);

    $document = TeacherDocument::create([
        'teacher_id' => $request->teacher_id,
        'document_name' => $request->document_name,
        'uploade_date' => $request->uploade_date,
        'document_file' => $filename,
    ]);

    $notification = array(
            'message' => 'teacher document successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('teacher_document')->with($notification);

    }


    public function download($filename){
        // مسیر کامل فایل در public
        $path = public_path('files/teacher_documents/' . $filename);
        // بررسی وجود فایل
        if (!file_exists($path)) {
            return redirect()->back()->with('error', 'Not Found !');
        }
        // دانلود فایل
        return response()->download($path);
    }


    public function DocumentEdit($id){
        $teacher = teacher::all();
        $document = TeacherDocument::find($id);

        return view('dashboard.teachers.teacher_documents.teacher_document_edit')->with('teachers' , $teacher)->with('document' , $document);
    }


    public function DocumentUpdate(Request $request , $id){
        $document = TeacherDocument::find($id);
        // dd($document);
        $data = $request->validate([
        'document_name' => ['required', 'string', 'max:255'],
        'uploade_date' => ['required', 'date'],
        'teacher_id' => ['required', 'integer'],
    ]);

    if(!is_null($request->document_file)){
           $request->validate([
                'document_file' => ['required' , 'file'],
            ]);
        }
    // dd($request->all());
    $document->teacher_id = $request->teacher_id;
    $document->document_name = $request->document_name;
    $document->uploade_date = $request->uploade_date;

    $document_file = $request->file('document_file');
    if($document_file){
        $filename = time() .'-'. $document_file->getClientOriginalName();
        $document_file->move(public_path('files/teacher_documents') . $filename);
            
        $document->document_file = $filename;
    }
    $document->save();
    $notification = array(
            'message' => 'teacher document successfuly updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('teacher_document')->with($notification);
    }


    public function DocumentDelete($id){
        $document = TeacherDocument::find($id);
                //پیدا کردن عکس 
                $path = public_path('files/teacher_documents').'/'.$document->document_file;
                //وجود داشتن عکس
                if(File::exists($path)){
                    File::delete($path);
                    $document->delete();
                }
                $notification = array(
            'message' => 'teacher document successfuly deleted !',
            'alert-type' => 'success'
        );
        return redirect()->route('teacher_document')->with($notification);
            }
}
