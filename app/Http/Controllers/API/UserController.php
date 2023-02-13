<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Response;

class UserController extends Controller
{
    public $userRepository;
    public $response;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->response = null;
    }
    public function index(Request $request)
    {
        allow('USER-VIEW');
        try {
            $this->response = $this->userRepository->all($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function store(UserCreateRequest $request)
    {
        allow('USER-CREATE');
        try {
            $this->response = $this->userRepository->create($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }


    public function show($id)
    {
        allow('USER-VIEW');
        try {
            $this->response = $this->userRepository->findById($id);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function update(UserUpdateRequest $request)
    {
        allow('USER-EDIT');
        try {
            $this->response = $this->userRepository->update($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function destroy($id)
    {
        allow('USER-DELETE');
        try {
            $this->response = $this->userRepository->delete($id);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
}
