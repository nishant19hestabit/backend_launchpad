<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Support\Facades\Response;

class CourseRepository
{
    public function all()
    {
        $courses = Course::all();
        if (count($courses) > 0) {
            return Response::json(['status' => true, 'message' => 'Courses founded successfully', 'data' => $courses], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'No course found'], 200);
        }
    }
    public function create($request)
    {
        $course = new Course();
        $course->name = $request->name;
        $course->save();
        if ($course) {
            return Response::json(['status' => true, 'message' => 'Course created successfully', 'data' => $course], 201);
        } else {
            return Response::json(['status' => false, 'message' => 'Something went wrong during creating course'], 200);
        }
    }
    public function findById($id)
    {
        $course = Course::findorfail($id);
        if (!empty($course)) {
            return Response::json(['status' => true, 'message' => 'Course found successfully', 'data' => $course], 200);
        } else {
            return Response::json(['status' => false, 'message' => 'Course not found'], 200);
        }
    }
    public function update($request)
    {
        $course = Course::findorfail($request->id);
        $course->name = $request->name;
        $course->save();
        return Response::json(['status' => true, 'message' => 'Course updated successfully'], 200);
    }
    public function delete($id)
    {
        $course = Course::findorfail($id);
        $course->delete();
        return Response::json(['status' => true, 'message' => 'Course deleted successfully'], 200);
    }
}
