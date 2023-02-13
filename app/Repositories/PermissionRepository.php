<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRepository
{
    public function all()
    {
        $permissions = Permission::all();
        if (count($permissions) > 0) {
            return Response::json(['status' => true, 'message' => 'Permissions founded successfully', 'data' => $permissions], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'No permission found'], 200);
        }
    }

    public function create($request)
    {
        $permission_name = $request->permission;
        $role_id = $request->role_id;
        $role = Role::findorfail($role_id);
        $permission = Permission::where('name', $permission_name)->first();
        if (empty($permission)) {
            return Response::json(['status' => false, 'message' => 'Permission does not exist'], 200);
        } elseif (empty($role)) {
            return Response::json(['status' => false, 'message' => 'Role does not exist'], 200);
        } else {
            $role->givePermissionTo($permission);
            return Response::json(['status' => true, 'message' => 'Permission assigned'], 200);
        }
    }
    public function delete($request)
    {
        $permission_name = $request->permission;
        $role_id = $request->role_id;
        $role = Role::findorfail($role_id);
        $permission = Permission::where('name', $permission_name)->first();
        if (empty($permission)) {
            return Response::json(['status' => false, 'message' => 'Permission does not exist'], 200);
        } elseif (empty($role)) {
            return Response::json(['status' => false, 'message' => 'Role does not exist'], 200);
        } else {
            $role->revokePermissionTo($permission);
            return Response::json(['status' => true, 'message' => 'Permission assigned'], 200);
        }
    }
}
