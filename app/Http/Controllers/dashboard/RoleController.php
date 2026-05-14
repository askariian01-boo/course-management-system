<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
     public function roles(){
        $data = Role::all();
        return view('dashboard.roles.roles' , compact('data'));
    }


    public function role_add(){
        return view('dashboard.roles.role_add');
    }


    public function role_save(Request $request){
        $request->validate([
            'name' => 'required|unique:roles,name'
        ]);

        Role::insert([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        $notification = array(
            'message' => 'Roles Successfuly created !',
            'alert-type' => 'success'
        );

        return redirect()->route('roles')->with($notification);
    }


    public function role_edit($id){
        $data = Role::FindOrFail($id);
        return view('dashboard.roles.role_edit' , compact('data'));
    }


    public function role_update(Request $request , $id){
        $request->validate([
            'name' => 'required'
        ]);

        Role::FindOrFail($id)->update([
            'name' => $request->name,
            'guard_name' => 'web'
        ]);

        $notification = array(
            'message' => 'Roles Successfuly updated !',
            'alert-type' => 'success'
        );

        return redirect()->route('roles')->with($notification);
    }


    public function role_delete($id){
        Role::FindOrFail($id)->delete();
        // alert message
        $notification = array(
            'message' => 'Roles Successfuly deleted !',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
