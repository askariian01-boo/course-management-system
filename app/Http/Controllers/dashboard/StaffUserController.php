<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class StaffUserController extends Controller
{

    public function index()
    {
        $users = User::where('role', 'staff')->with('staff')->get();
        return view('dashboard.users.staff.staff_user_list', compact('users'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.staff.staff_user_add', compact('roles'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'user_name' => ['required', 'string', 'min:4', 'max:20', 'unique:users,user_name'],
            'password' => ['required', 'string', 'min:4', 'max:20', 'confirmed'],
        ]);

        $user = User::create([
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
            'role' => 'staff'
        ]);
        // assign roles to staff user
        if ($request->roles) {
            $user->assignRole($request->roles);
        }
        $notification = array(
            'message' => 'staff user account successfuly created !',
            'alert-type' => 'success'
        );
        return redirect()->route('user_list')->with($notification);
    }


    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('dashboard.users.staff.staff_user_edit', compact('user', 'roles'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'user_name' => ['required', 'string', 'min:4', 'max:20', 'unique:users,user_name,' . $id],
        ]);

        $user->user_name = $data['user_name'];
        $user->role = 'staff';
        $user->save();
        // assign roles to staff user
        $user->roles()->detach();
        if ($request->roles) {
            $user->assignRole($request->roles);
        }

        $notification = array(
            'message' => 'staff user account successfuly updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('user_list')->with($notification);
    }


    public function destroy($id)
    {
        $user = User::findOrFail($id);
        if (!is_null($user)) {
            $user->delete();
        }
        $notification = array(
            'message' => 'staff user account successfuly deleted !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
