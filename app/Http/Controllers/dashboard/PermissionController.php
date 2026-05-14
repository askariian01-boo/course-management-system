<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
      public function permissions(){
        $data = Permission::orderBy('group_name')->get()->all();
        return view('dashboard.permissions.permissions' , compact('data'));
    }


    public function permission_add(){
        return view('dashboard.permissions.permission_add');
    }


    public function permission_save(Request $request){
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:permissions,name|max:64',
            'group_name' =>'nullable|max:64'
        ]);

        Permission::insert([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'guard_name' => 'web'
         ]);

         $notification = array(
            'message' => 'permission successfuly created !',
            'alert-type' => 'success'
         );

        //  return redirect()->back();
         return redirect()->route('list_permission')->with($notification);
    }


    public function permission_edit($id){
        $data = Permission::FindOrFail($id);
        return view('dashboard.permissions.permission_edit' , compact('data'));
    }


    public function permission_update(Request $request , $id){
        $request->validate([
            'name' => 'required|unique:permissions,name|max:64',
        ]);

        Permission::FindOrFail($id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'guard_name' => 'web'
        ]);

        $notification = array(
            'message' => 'permission successfuly updated !',
            'alert-type' => 'success'
         );

         return redirect()->route('list_permission')->with($notification);
    }

    public function permission_delete($id){
        Permission::FindOrFail($id)->delete();

        $notification = array(
            'message' => 'permission successfuly deleted !',
            'alert-type' => 'success'
         );
         return redirect()->back()->with($notification);
    }
}
