<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionAssignRequest;
use App\Repositories\PermissionRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PermissionController extends Controller
{
    public $permissionRepository;
    public $response;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->response = null;
    }
    public function index()
    {
        try {
            $this->response = $this->permissionRepository->all();
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function store(PermissionAssignRequest $request)
    {
        try {
            $this->response = $this->permissionRepository->create($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
    public function delete(PermissionAssignRequest $request)
    {
        try {
            $this->response = $this->permissionRepository->delete($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
    
}
