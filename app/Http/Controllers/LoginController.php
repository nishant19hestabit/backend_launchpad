<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repositories\LoginRepository;
use Exception;
use Illuminate\Support\Facades\Artisan;

class LoginController extends Controller
{
    public $loginRepository;
    public $response;

    public function __construct(LoginRepository $loginRepository)
    {
        $this->loginRepository = $loginRepository;
        $this->response = null;
    }
    public function index()
    {
        try {
            $this->response = $this->loginRepository->welcome();
        } catch (Exception $e) {
            $this->response = redirect()->back()->with('error', $e->getMessage());
        }
        return $this->response;
    }
    public function login()
    {
        try {
            $this->response = $this->loginRepository->login();
        } catch (Exception $e) {
            $this->response = redirect()->back()->with('error', $e->getMessage());
        }
        return $this->response;
    }
    public function loginCheck(LoginRequest $request)
    {
        try {
            $this->response = $this->loginRepository->check($request);
        } catch (Exception $e) {
            $this->response = redirect()->back()->with('error', $e->getMessage());
        }
        return $this->response;
    }
    public function logout()
    {
        try {
            $this->response = $this->loginRepository->logout();
        } catch (Exception $e) {
            $this->response = redirect()->back()->with('error', $e->getMessage());
        }
        return $this->response;
    }
}
