<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherUserController extends Controller
{
    // LIST
    public function index()
    {
        $users = User::where('role', 'teacher')->with('teacher')->get();
        return view('dashboard.users.teacher.teacher_user_list', compact('users'));
    }

    // CREATE FORM
    public function create()
    {
        return view('dashboard.users.teacher.teacher_user_add');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string|min:3|max:50|unique:users,user_name',
            'password' => 'required|min:4|confirmed',
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
            'role' => 'teacher'
        ]);

        $user->assignRole('teacher');

        $notification = array(
            'message' => 'teacher user account successfuly created !',
            'alert-type' => 'success'
        );

        return redirect()->route('teacher_user_list')->with($notification);
    }

    // EDIT
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.teacher.teacher_user_edit', compact('user'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'user_name' => 'required|string|min:3|max:50|unique:users,user_name,' . $id,
        ]);

        $user->update([
            'user_name' => $request->user_name,
            'role' => 'teacher'
        ]);

        $user->syncRoles(['teacher']);

        $notification = array(
            'message' => 'teahcer user account successfuly updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('teacher_user_list')->with($notification);
    }

    // DELETE
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $notification = array(
            'message' => 'teacher user account successfuly deleted !',
            'alert-type' => 'success'
        );

        return back()->with($notification);
    }
}
