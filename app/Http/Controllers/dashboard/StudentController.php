<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('dashboard.students.student_list')->with('students', $students);
    }

    public function StudentDetail($id)
    {
        $student = Student::find($id);
        return view('dashboard.students.student_detail')->with('student', $student);
    }

    public function StudentAdd()
    {
        $classes = Classes::all();
        return view('dashboard.students.student_add')->with('classes', $classes);
    }


    public function StudentSave(Request $request)
    {
        // dd($request->all());
        $Data = $request->validate([
            'FirstName' => ['required', 'string', 'max:255'],
            'LastName' => ['required', 'string', 'max:255'],
            'FatherName' => ['required', 'string', 'max:255'],
            'Address' => ['required', 'string', 'max:255'],
            'RegDate' => ['required', 'date'],
            'BirthDay' => ['required', 'date'],
            'Phone' => ['required', 'string', 'max:14', 'unique:students,Phone'],
            'NIC' => ['required', 'string', 'max:30', 'unique:students,NIC'],
            'Image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'class_id' => ['required', 'numeric'],
        ]);

        $image = $request->file('Image');
        $imagename = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('images/Students'), $imagename);

        $Student = Student::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'FatherName' => $request->FatherName,
            'Gender' => $request->Gender,
            'MaritalStatus' => $request->MaritalStatus,
            'Phone' => $request->Phone,
            'Address' => $request->Address,
            'NIC' => $request->NIC,
            'RegDate' => $request->RegDate,
            'BirthDay' => $request->BirthDay,
            'class_id' => $request->class_id,
            'Image' => $imagename,
        ]);

        $notification = array(
            'message' => 'student successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('students')->with($notification);
    }


    public function StudentEdit($id)
    {
        $student = Student::find($id);
        $class = Classes::all();
        return view('dashboard.students.student_edit')->with('student', $student)->with('classes', $class);
    }


    public function StudentUpdate(Request $request, $id)
    {
        $student = Student::find($id);
        $Data = $request->validate([
            'FirstName' => ['required', 'string', 'max:255'],
            'LastName' => ['required', 'string', 'max:255'],
            'FatherName' => ['required', 'string', 'max:255'],
            'Address' => ['required', 'string', 'max:255'],
            'RegDate' => ['required', 'date'],
            'BirthDay' => ['required', 'date'],
            'Phone' => ['required', 'string', 'max:14', 'min:9', 'unique:students,Phone,' . $id],
            'NIC' => ['required', 'string', 'max:30', 'unique:students,NIC,' . $id],
            'class_id' => ['required', 'numeric'],
        ]);

        // dd($Data);
        if (!is_null($request->Image)) {
            $request->validate([
                'Image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048']
            ]);
        }
        $student->FirstName = $request->FirstName;
        $student->LastName = $request->LastName;
        $student->FatherName = $request->FatherName;
        $student->BirthDay = $request->BirthDay;
        $student->Gender = $request->Gender;
        $student->MaritalStatus = $request->MaritalStatus;
        $student->Address = $request->Address;
        $student->Phone = $request->Phone;
        $student->NIC = $request->NIC;
        $student->RegDate = $request->RegDate;
        $student->class_id = $request->class_id;

        $image = $request->file('image');
        if ($image) {
            $imagename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/students'), $imagename);
            $student->image = $imagename;
        }

        $student->save();
        // dd('saved');
        $notification = array(
            'message' => 'student successfuly updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('students')->with($notification);
    }

    public function StudentDelete($id)
    {
        $student = Student::find($id);
        $path = public_path('images/students') . '/' . $student->Image;
        //وجود داشتن عکس
        if (File::exists($path)) {
            File::delete($path);
            $student->delete();
        }
       $notification = array(
            'message' => 'student successfuly deleted !',
            'alert-type' => 'success'
        );
        return redirect()->route('students')->with($notification);
    }
}
