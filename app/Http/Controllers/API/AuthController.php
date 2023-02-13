<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UpdateRequest;
use App\Repositories\AuthRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public $authRepository;
    public $response;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
        $this->response = null;
    }

    public function show(Request $request)
    {
        try {
            $this->response = $this->authRepository->findByID($request->user()->id);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
    public function update(UpdateRequest $request)
    {
        try {
            $this->response = $this->authRepository->update($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
    public function login(LoginRequest $request)
    {
        try {
            $this->response = $this->authRepository->login($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
    public function logout()
    {
        try {
            $this->response = $this->authRepository->logout();
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
}
