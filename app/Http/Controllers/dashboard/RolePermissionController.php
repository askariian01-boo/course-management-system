<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
     public function roles_permissions_list(){
        $roles = Role::all();
        return view('dashboard.role permission.permission_roles_list' , compact('roles'));
    }


    // assigned permissions has roles
    public function assign_permission(){
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_Group = User::permissions_groups();
        return view('dashboard.role permission.role_assign_permission' , compact('roles' , 'permissions' , 'permission_Group'));
    }


    // assigned permissions roles save in to database
    public function save_permission_role(Request $request){
        // dd($request->all());
        $data = array();
        $permissions = $request->permissions;
        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;

            DB::table('role_has_permissions')->insert($data);
        }

        // alert message
        $notification = array(
            'message' => 'permissions successfully asigned !',
            'alert-type' => 'success'
        );
        return redirect()->route('roles_permissions_list')->with($notification);
    }


    public function edit_permission_role($id){
        $roles = Role::FindOrFail($id);
        $permissions = Permission::all();
        $permission_Group = User::permissions_groups();
        return view('dashboard.role permission.role_edit_permission' , compact('roles' , 'permissions' , 'permission_Group'));
    }


    public function update_permission_role(Request $request , $id){
        $role = Role::FindOrFail($id);
        $permissions = $request->permissions;

        if(!empty($permissions)){
            $role->syncPermissions($permissions);
        }

        // alert message
        $notification = array(
            'message' => 'permissions successfully updated !',
            'alert-type' => 'success'
        );
        return redirect()->route('roles_permissions_list')->with($notification);
    }



    public function permission_roles_delete($id){
        $role = Role::FindOrFail($id);
        if(!is_null($role)){
            $role->delete();
        }
        //alert message
        $notification = array(
            'message' => 'permissions successfully Deleted !',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
