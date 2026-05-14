<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{
    public function index()
    {
        $teacher = Teacher::all();
        return view('dashboard.teachers.teacher_list')->with('teachers', $teacher);
    }


    public function TeacherDetail($id)
    {
        $teacher = Teacher::find($id);
        return view('dashboard.teachers.teacher_detail')->with('teacher', $teacher);
    }

    public function TeacherAdd()
    {
        $user = User::where('role', 'teacher')->get();
        return view('dashboard.teachers.teacher_add')->with('users', $user);
    }

    
    public function TeacherSave(Request $request)
    {
        // dd($request->all());
       

        $Data = $request->validate([
            'FirstName' => ['required', 'string', 'max:255'],
            'LastName' => ['required', 'string', 'max:255'],
            'FatherName' => ['required', 'string', 'max:255'],
            'Address' => ['required', 'string', 'max:255'],
            'EducationDegree' => ['required', 'string', 'max:255'],
            'EducationUniversity' => ['required', 'string', 'max:255'],
            'EducationYear' => ['required', 'numeric'],
            'TalnetScore' => ['required', 'numeric', 'max:100'],
            'GrossSalary' => ['required', 'numeric', 'min:0'],
            'RegDate' => ['required', 'date'],
            'BirthDay' => ['required', 'date'],
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:teachers,Email'],
            'Phone' => ['required', 'string', 'max:14', 'unique:teachers,Phone'],
            'NIC' => ['required', 'string', 'max:30', 'unique:teachers,NIC'],
            'Image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:12000'],
        ]);


        // ذخیره تصویر و دریافت نام فایل
        $image = $request->file('Image');
        $imagename = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('images/Teachers'), $imagename);


        $Teacher = Teacher::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'FatherName' => $request->FatherName,
            'Gender' => $request->Gender,
            'MaritalStatus' => $request->MaritalStatus,
            'Phone' => $request->Phone,
            'Image' => $request->Image,
            'Email' => $request->Email,
            'Address' => $request->Address,
            'NIC' => $request->NIC,
            'EducationDegree' => $request->EducationDegree,
            'EducationUniversity' => $request->EducationUniversity,
            'EducationYear' => $request->EducationYear,
            'TalnetScore' => $request->TalnetScore,
            'GrossSalary' => $request->GrossSalary,
            'RegDate' => $request->RegDate,
            'BirthDay' => $request->BirthDay,
            'user_id' => $request->user_id,
            'Image' => $imagename,
        ]);


        $notification = array(
            'message' => 'teacher successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('teacher_list')->with($notification);
    }



    public function TeacherEdit($id)
    {
        $teacher = Teacher::find($id);
        $users = User::where('role', 'teacher')->get();
        return view('dashboard.teachers.teacher_edit' , compact('teacher' , 'users'));
    }


    public function TeacherUpdate(Request $request, $id)
    {
        $teacher = Teacher::find($id);

        $request->validate([
            'FirstName' => ['required', 'string', 'max:255'],
            'LastName' => ['required', 'string', 'max:255'],
            'FatherName' => ['required', 'string', 'max:255'],
            'Address' => ['required', 'string', 'max:255'],
            'EducationDegree' => ['required', 'string', 'max:255'],
            'EducationUniversity' => ['required', 'string', 'max:255'],
            'EducationYear' => ['required', 'numeric'],
            'TalnetScore' => ['required', 'numeric', 'max:100'],
            'FoodCharge' => ['required', 'numeric'],
            'GrassSalary' => ['required', 'numeric', 'min:0'],
            'RegDate' => ['required', 'date'],
            'BirthDay' => ['required', 'date'],
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:teachers,Email,' . $id],
            'Phone' => ['required', 'string', 'max:14', 'unique:teachers,phone,' . $id],
            'NIC' => ['required', 'string', 'max:30', 'unique:teachers,NIC,' . $id],
        ]);

        if (!is_null($request->Image)) {
            $request->validate([
                'Image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            ]);
        }

        $teacher->FirstName = $request->FirstName;
        $teacher->LastName = $request->LastName;
        $teacher->FatherName = $request->FatherName;
        $teacher->Phone = $request->Phone;
        $teacher->Email = $request->Email;
        $teacher->Address = $request->Address;
        $teacher->NIC = $request->NIC;
        $teacher->BirthDay = $request->BirthDay;
        $teacher->RegDate = $request->RegDate;
        $teacher->Gender = $request->Gender;
        $teacher->MaritalStatus = $request->MaritalStatus;
        $teacher->GrossSalary = $request->GrassSalary;
        $teacher->EducationDegree = $request->EducationDegree;
        $teacher->EducationUniversity = $request->EducationUniversity;
        $teacher->EducationYear = $request->EducationYear;
        $teacher->TalnetScore = $request->TalnetScore;
        $teacher->FoodCharge = $request->FoodCharge;
        $teacher->user_id = $request->user_id;

        $image = $request->file('image');
        if ($image) {
            $imagename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/teachers'), $imagename);
            $teacher->image = $imagename;
        }
        $teacher->save();

        $notification = array(
            'message' => 'teacher successfuly updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('teacher_list')->with($notification);
    }


    public function TeacherDelete($id)
    {
        $teacher = Teacher::find($id);
        //پیدا کردن عکس 
        $path = public_path('images/teachers') . '/' . $teacher->Image;
        //وجود داشتن عکس
        if (File::exists($path)) {
            File::delete($path);
            $teacher->delete();
        }
        $notification = array(
            'message' => 'teacher successfuly deleted !',
            'alert-type' => 'success'
        );
        return redirect()->route('teacher_list')->with($notification);
    }
}
