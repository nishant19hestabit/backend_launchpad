<?php

namespace App\Repositories;

use App\Models\Notification;
use Illuminate\Support\Facades\Response;

class NotificationRepository
{
    public function all()
    {
        $notifications = Notification::all();
        if (count($notifications) > 0) {
            return Response::json(['status' => true, 'message' => 'Notification list founded successfully', 'data' => $notifications], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'No notification found'], 200);
        }
    }
    public function create($request)
    {
        $notification = new Notification();
        $notification->title = $request->title;
        $notification->description = $request->description;
        $data = $notification->save();
        if ($data) {
            return Response::json(['status' => true, 'message' => 'Notification created successfully', 'data' => $notification], 201);
        } else {
            return Response::json(['status' => false, 'message' => 'Something went wrong during creating notification'], 200);
        }
    }
    public function findById($id)
    {
        $notification = Notification::findorfail($id);
        if (!empty($notification)) {
            return Response::json(['status' => true, 'message' => 'Notification found successfully', 'data' => $notification], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'Notification not found'], 200);
        }
    }
    public function update($request)
    {
        $notification = Notification::findorfail($request->id);
        $notification->title = $request->title;
        $notification->description = $request->description;
        $notification->save();
        return Response::json(['status' => true, 'message' => 'Notification updated successfully'], 200);
    }
    public function delete($id)
    {
        $notification = Notification::findorfail($id);
        $notification->delete();
        return Response::json(['status' => true, 'message' => 'Notification deleted successfully'], 200);
    }
}
