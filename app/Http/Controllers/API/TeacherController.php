<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\TeacherRepository;
use Exception;
use Illuminate\Support\Facades\Response;

class TeacherController extends Controller
{
    public $teacherRepository;
    public $response;

    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
        $this->response = null;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $this->response = $this->teacherRepository->store($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
    
}
