<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Http\Requests\AttendanceUpdateRequest;
use App\Repositories\AttendanceRepository;
use Exception;
use Illuminate\Support\Facades\Response;

class AttendanceController extends Controller
{
    public $attendanceRepository;
    public $response;

    public function __construct(AttendanceRepository $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
        $this->response = null;
    }

    public function index($user_id)
    {
        allow('ATTENDANCE-VIEW');
        try {
            $this->response = $this->attendanceRepository->all($user_id);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function store(AttendanceRequest $request)
    {
        allow('ATTENDANCE-CREATE');
        try {
            $this->response = $this->attendanceRepository->create($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function show($id)
    {
        allow('ATTENDANCE-VIEW');
        try {
            $this->response = $this->attendanceRepository->findByid($id);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function update(AttendanceUpdateRequest $request)
    {
        allow('ATTENDANCE-EDIT');
        try {
            $this->response = $this->attendanceRepository->update($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function destroy($id)
    {
        allow('ATTENDANCE-DELETE');
        try {
            $this->response = $this->attendanceRepository->delete($id);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
}
