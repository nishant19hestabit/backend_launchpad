<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class LoginRepository
{
    public function welcome()
    {
        return view('welcome');
    }

    public function login()
    {
        if (!Auth::check()) {
            return view('login');
        }
        return redirect()->to('/');
    }

    public function check($request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $data = Auth::attempt($credentials);
        if ($data) {
            return redirect()->to('/');
        } else {
            return redirect()->back()->with('error', 'Invalid Credentials')->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->to('/')->with('success', 'logout successfully');
    }
}
