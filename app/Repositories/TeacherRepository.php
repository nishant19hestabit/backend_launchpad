<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;

class TeacherRepository
{
    public function store($request)
    {
        $teacher = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if (!empty($teacher)) {
            $role = Role::findorfail(2);
            $teacher->assignRole($role->name);
            return Response::json(['status' => true, 'message' => 'Teacher created successfully', 'data' => $teacher], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'Something went wrong', 'data' => ''], 200);
        }
    }
    
}
