<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Spatie\Permission\Models\Role;

class StudentRepository
{
    public function store($request)
    {
        $student = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if (!empty($student)) {
            $role = Role::findorfail(3);
            $student->assignRole($role->name);
            return Response::json(['status' => true, 'message' => 'Student created successfully', 'data' => $student], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'Something went wrong', 'data' => ''], 200);
        }
    }
    
}
