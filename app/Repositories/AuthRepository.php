<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;

class AuthRepository
{
    public function findByID($id)
    {
        $profile = User::with('roles')->findorfail($id);
        return Response::json(['status' => true, 'message' => 'Profile fetched', 'data' => $profile], 200);
    }
    public function update($request)
    {
        $user = User::findorfail($request->user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($user->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return Response::json(['status' => true, 'message' => 'Profile updated', 'data' => $user], 200);
    }
    public function login($request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password];
        $data = auth()->attempt($credentials);
        if (!$data) {
            return Response::json(['status' => false, 'message' => 'Invalid Credentials'], 200);
        } else {
            $data = '';
            if (auth()->user()->hasRole('student')) {
                $data = 'student';
            } elseif (auth()->user()->hasRole('teacher')) {
                $data = 'teacher';
            } elseif (auth()->user()->hasRole('admin')) {
                $data = 'admin';
            }
            $token = auth()->user()->createToken($data)->accessToken;
            return Response::json(['status' => true, 'message' => 'Login Successfully', 'role' => $data, 'token' => $token], 200);
        }
    }
    public function logout()
    {
        $user = auth()->user()->token();
        $user->revoke();
        return Response::json(['status' => true, 'message' => 'Logout Successfully'], 200);
    }
}
