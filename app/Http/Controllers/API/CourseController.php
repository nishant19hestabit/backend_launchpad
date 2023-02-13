<?php

namespace App\Http\Controllers\API;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Repositories\CourseRepository;
use Exception;
use Illuminate\Support\Facades\Response;

class CourseController extends Controller
{
    public $courseRepository;
    public $response;

    public function __construct(CourseRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
        $this->response = null;
    }
    public function index()
    {
        allow('COURSE-VIEW');
        try {
            $this->response = $this->courseRepository->all();
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function store(CourseRequest $request)
    {
        allow('COURSE-CREATE');
        try {
            $this->response = $this->courseRepository->create($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    
    public function show($id)
    {
        allow('COURSE-VIEW');
        try {
            $this->response = $this->courseRepository->findById($id);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function update(CourseUpdateRequest $request)
    {
        allow('COURSE-EDIT');
        try {
            $this->response = $this->courseRepository->update($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function destroy($id)
    {
        allow('COURSE-DELETE');
        try {
            $this->response = $this->courseRepository->delete($id);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
}
