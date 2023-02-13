<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\StudentRepository;
use Exception;
use Illuminate\Support\Facades\Response;

class StudentController extends Controller
{
    public $studentRepository;
    public $response;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
        $this->response = null;
    }

    public function register(RegisterRequest $request)
    {
        try {
            $this->response = $this->studentRepository->store($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
    
}
