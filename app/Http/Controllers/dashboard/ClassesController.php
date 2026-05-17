<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classes;
// use Faker\Core\File;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\File as FacadesFile;
use Illuminate\Support\Facades\File;

class ClassesController extends Controller
{
    public function index(){
        $classes = Classes::all();
        return view('dashboard.classes.class_list')->with('classes' , $classes);
    }

    public function ClassDetail($id){
        $class = Classes::find($id);
        // dd($class->subjects);
        // $class = Classes::with(['subjects' , 'students' ])->findOrFail($id);
        return view('dashboard.classes.class_detail')->with('class' , $class);
    }


    public function ClassAdd(){
        return view ('dashboard.classes.class_add');
    }


    public function ClassSave(Request $request){
        $data = $request->validate([
            'ClassName' => ['required', 'string', 'max:50'],
            'ClassFees' => ['required', 'numeric'],
            'description' => ['nullable', 'string'],
            'capacity' => ['nullable', 'integer'],
            'image' => ['nullable', 'image', 'max:6048'],
        ]);

        // dd($data);

        $image = $request->file('image');
        $imagename = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('images/Classes'), $imagename);

        $data = Classes::create([
            'ClassName' => $request->ClassName,
            'ClassFees' => $request->ClassFees,
            'description' => $request->description,
            'capacity' => $request->capacity,
            'image' => $imagename,
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
            'description' => ['nullable', 'string'],
            'capacity' => ['nullable', 'integer'],
        ]);
        if (!is_null($request->image)) {
            $request->validate([
                'image' => ['nullable', 'image', 'max:6048']
            ]);
        }

        $class->ClassName = $request->ClassName;
        $class->ClassFees = $request->ClassFees;
        $class->description = $request->description;
        $class->capacity = $request->capacity;
 
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/Classes'), $imagename);
            $class->image = $imagename;
        }
 
        $class->save();

        $notification = array(
            'message' => 'class successfuly updated !',
            'alert-type' => 'success'
         );
    return redirect()->route('classes')->with($notification);
    }


    public function ClassDelete($id){
        $class = Classes::find($id);
         //پیدا کردن عکس 
        $path = public_path('images/classes') . '/' . $class->Image;
        //وجود داشتن عکس
        if (File::existe($path)) {
            File::delete($path);
            $class->delete();
        }

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
