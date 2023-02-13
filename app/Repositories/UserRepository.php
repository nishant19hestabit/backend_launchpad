<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;

class UserRepository
{
    public function all($request)
    {
        if ($request->user()->hasRole('teacher')) {
            $users = User::whereHas('roles', function ($q) {
                $q->where('name', '=', 'student');
            })->with('roles')->get(10);
        } else {
            $users = User::whereHas('roles', function ($q) {
                $q->where('name', '!=', 'admin');
            })->with('roles')->get(10);
        }
        if (count($users) > 0) {
            return Response::json(['status' => true, 'message' => 'User list founded successfully', 'data' => $users], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'No user found'], 200);
        }
    }
    public function create($request)
    {
        if ($this->roleExist($request->role)) {
            if ($request->role == 'admin') {
                return Response::json(['status' => false, 'message' => 'Permission Denied'], 403);
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                $user->assignRole($request->role);
                if ($user) {
                    return Response::json(['status' => true, 'message' => 'User created successfully', 'data' => $user], 201);
                } else {
                    return Response::json(['status' => false, 'message' => 'Something went wrong during creating user'], 200);
                }
            }
        } else {
            return Response::json(['status' => false, 'message' => 'Role not found'], 200);
        }
    }
    public function findById($id)
    {
        $user = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'admin');
        })->findorfail($id);
        if (!empty($user)) {
            return Response::json(['status' => true, 'message' => 'User found successfully', 'data' => $user], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'User not found'], 200);
        }
    }
    public function update($request)
    {
        $user = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'admin');
        })->findorfail($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return Response::json(['status' => true, 'message' => 'User updated successfully', 'data' => $user], 200);
    }
    public function delete($id)
    {
        $user = User::whereHas('roles', function ($q) {
            $q->where('name', '!=', 'admin');
        })->findorfail($id);
        $user->delete();
        return Response::json(['status' => true, 'message' => 'User deleted successfully'], 200);
    }
    public function roleExist($role)
    {
        $role = Role::where('name', $role)->first();
        return !empty($role) ? true : false;
    }
}
