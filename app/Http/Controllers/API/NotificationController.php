<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationCreateRequest;
use App\Http\Requests\NotificationUpdateRequest;
use App\Models\Notification;
use App\Repositories\NotificationRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class NotificationController extends Controller
{
    public $notificationRepository;
    public $response;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
        $this->response = null;
    }
    public function index()
    {
        allow('NOTIFICATION-VIEW');
        try {
            $this->response = $this->notificationRepository->all();
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function store(NotificationCreateRequest $request)
    {
        allow('NOTIFICATION-CREATE');
        try {
            $this->response = $this->notificationRepository->create($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    
    public function show($id)
    {
        allow('NOTIFICATION-VIEW');
        try {
            $this->response = $this->notificationRepository->findById($id);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function update(NotificationUpdateRequest $request)
    {
        allow('NOTIFICATION-EDIT');
        try {
            $this->response = $this->notificationRepository->update($request);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }

    public function destroy($id)
    {
        allow('NOTIFICATION-DELETE');
        try {
            $this->response = $this->notificationRepository->delete($id);
        } catch (Exception $e) {
            $this->response = Response::json(['status' => false, 'message' => $e->getMessage()], 500);
        }
        return $this->response;
    }
}
