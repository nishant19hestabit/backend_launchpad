<?php

namespace App\Repositories;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class AttendanceRepository
{
    public function all($user_id)
    {
        $data = Attendance::where('user_id', $user_id)->get();
        if (count($data) > 0) {
            return Response::json(['status' => true, 'message' => 'Attendance found successfully', 'data' => $data], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'No attendance found'], 200);
        }
    }
    public function create($request)
    {
        $user = User::findorfail($request->user_id);
        if ($user->hasRole('admin')) {
            return Response::json(['status' => false, 'message' => 'Wrong user id'], 200);
        } else {

            if (!$this->attendanceExist($request->user_id)) {
                $attendance = new Attendance();
                $attendance->user_id = $request->user_id;
                $attendance->status = $request->status;
                $attendance->date = date('Y-m-d');
                $attendance->save();
                if ($attendance) {
                    return Response::json(['status' => true, 'message' => 'Attendance ' . $request->status . ' marked'], 201);
                } else {
                    return Response::json(['status' => false, 'message' => 'Something went wrong during creating course'], 200);
                }
            } else {
                return Response::json(['status' => false, 'message' => 'Attendance already exist'], 200);
            }
        }
    }
    public function findById($id)
    {
        $attendance = Attendance::with('userDetails')->findorfail($id);
        if (!empty($attendance)) {
            return Response::json(['status' => true, 'message' => 'Attendance found successfully', 'data' => $attendance], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'Attendance not found'], 200);
        }
    }
    public function update($request)
    {
        $attendance = Attendance::findorfail($request->id);
        $attendance->status = $request->status;
        $attendance->save();
        return Response::json(['status' => true, 'message' => 'Attendance updated successfully'], 200);
    }
    public function delete($id)
    {
        $attendance = Attendance::findorfail($id);
        $attendance->delete();
        return Response::json(['status' => true, 'message' => 'Attendance deleted successfully'], 200);
    }
    public function attendanceExist($user_id)
    {
        $attendance = Attendance::where(['user_id' => $user_id, 'date' => date('Y-m-d')])->first();
        return !empty($attendance) ? true : false;
    }
}
