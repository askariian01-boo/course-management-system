<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Staff;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redis;

class StaffController extends Controller
{
    //نمایش تمام کارمندان
    public function index()
    {
        $staffs = Staff::all();
        return view('dashboard.staff.staff_list')->with('staffs', $staffs);
    }


    public function StaffDetail($id)
    {
        $staff = Staff::find($id);
        return view('dashboard.staff.staff_detail')->with('staff', $staff);
    }

    //فارم ذخیره کارمند جدید 
    public function StaffAdd()
    {
        $users = User::where('role', 'staff')->get();
        return view('dashboard.staff.staff_add')->with('users', $users);
    }


    //ذخیره اطلاعات کارمند در دیتابیس
    public function StaffSave(Request $request)
    {
        // dd($request->all());
        $Data = $request->validate([
            'FirstName' => ['required', 'string', 'max:255'],
            'LastName' => ['required', 'string', 'max:255'],
            'FatherName' => ['required', 'string', 'max:255'],
            'Address' => ['required', 'string', 'max:255'],
            'Position' => ['required', 'string', 'max:64'],
            'GrossSalary' => ['required', 'numeric', 'min:0'],
            'RegDate' => ['required', 'date'],
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:staff,Email'],
            'phone' => ['required', 'string', 'max:14', 'unique:staff,phone'],
            'NIC' => ['required', 'string', 'max:30', 'unique:staff,NIC'],
            'Image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:12048'],
        ]);

        // ذخیره تصویر و دریافت نام فایل
        $image = $request->file('Image');
        $imagename = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('images/Staff'), $imagename);

        // ذخیره در دیتابیس
        $Staff = Staff::create([
            'FirstName' => $request->FirstName,
            'LastName' => $request->LastName,
            'FatherName' => $request->FatherName,
            'Gender' => $request->Gender,
            'phone' => $request->phone,
            'Position' => $request->Position,
            'Email' => $request->Email,
            'Address' => $request->Address,
            'NIC' => $request->NIC,
            'GrossSalary' => $request->GrossSalary,
            'RegDate' => $request->RegDate,
            'user_id' => $request->user_id,
            'Image' => $imagename,
        ]);

        $notification = array(
            'message' => 'staff successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('staff_list')->with($notification);
    }


    //فارم ویرایش مشخصات کارمندان
    public function StaffEdit($id)
    {
        $staff = Staff::find($id);
        $users = User::where('role', 'staff')->get();
        // dd($staff);
        return view('dashboard.staff.staff_edit' , compact('staff' , 'users'));
    }


    //ذخیره اطلاعات ویرایش شده کارمند
    public function StaffUpdate(Request $request, $id)
    {
        $Data = Staff::find($id);
        $request->validate([
            'FirstName' => ['required', 'string', 'max:255'],
            'LastName' => ['required', 'string', 'max:255'],
            'FatherName' => ['required', 'string', 'max:255'],
            'Address' => ['required', 'string', 'max:255'],
            'Position' => ['required', 'string', 'max:64'],
            'GrossSalary' => ['required', 'numeric', 'min:0'],
            'RegDate' => ['required', 'date'],
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:staff,Email,' . $id],
            'phone' => ['required', 'string', 'max:14', 'unique:staff,phone,' . $id],
            'NIC' => ['required', 'string', 'max:30', 'unique:staff,NIC,' . $id],
        ]);

        // اگر عکس انتخاب شد اعتبار سنجی کن
        if (!is_null($request->Image)) {
            $request->validate([
                'Image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:12048']
            ]);
        }

        // ذخیره در دیتابیس
        $Data->FirstName = $request->FirstName;
        $Data->LastName = $request->LastName;
        $Data->FatherName = $request->FatherName;
        $Data->Address = $request->Address;
        $Data->phone = $request->phone;
        $Data->Position = $request->Position;
        $Data->Email = $request->Email;
        $Data->NIC = $request->NIC;
        $Data->GrossSalary = $request->GrossSalary;
        $Data->RegDate = $request->RegDate;
        $Data->user_id = $request->user_id;

        // دریافت عکس و ذخیره آن 
        $image = $request->file('image');
        if ($image) {
            $imagename = time() . '-' . $image->getClientOriginalName();
            $image->move(public_path('images/staff'), $imagename);
            $Data->image = $imagename;
        }
        $Data->save();
        $notification = array(
            'message' => 'staff successfuly updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('staff_list')->with($notification);
    }


    // حذف کارمند
    public function StaffDelete($id)
    {
        $staff = Staff::find($id);
        //پیدا کردن عکس 
        $path = public_path('images/staff') . '/' . $staff->Image;
        //وجود داشتن عکس
        if (File::exists($path)) {
            File::delete($path);
            $staff->delete();
        }
         $notification = array(
            'message' => 'staff successfuly deleted !',
            'alert-type' => 'success'
        );
        return redirect()->route('staff_list')->with($notification);
    }
}
