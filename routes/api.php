<?php

use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CourseController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\PermissionController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\StudentController;
use App\Http\Controllers\API\TeacherController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/teacher-register', [TeacherController::class, 'register']);
Route::post('/student-register', [StudentController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function () {
    //logged user
    Route::get('/profile', [AuthController::class, 'show']);
    Route::put('/profile/update', [AuthController::class, 'update']);
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::group(['middleware' => 'IsAdmin'], function () {

        Route::get('/roles', [RoleController::class, 'index']);
        Route::get('/permissions', [PermissionController::class, 'index']);
        Route::post('/permission-assign', [PermissionController::class, 'store']);
        Route::post('/permission-remove', [PermissionController::class, 'delete']);
    });



    //Courses
    Route::get('/courses', [CourseController::class, 'index']);
    Route::post('/course/create', [CourseController::class, 'store'])->middleware('IsAdmin');
    Route::get('/course/show/{id}', [CourseController::class, 'show']);
    Route::put('/course/update', [CourseController::class, 'update']);
    Route::delete('/course/delete/{id}', [CourseController::class, 'destroy'])->middleware('IsAdmin');

    //Attendance
    Route::get('/attendance/{user_id}', [AttendanceController::class, 'index'])->middleware('IsAdmin');
    Route::post('/attendance/marked', [AttendanceController::class, 'store']);
    Route::get('/attendance/show/{id}', [AttendanceController::class, 'show']);
    Route::put('/attendance/update', [AttendanceController::class, 'update']);
    Route::delete('/attendance/delete/{id}', [AttendanceController::class, 'destroy']);

    //Notifications
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::post('/notification/create', [NotificationController::class, 'store'])->middleware('IsAdmin');
    Route::get('/notification/show/{id}', [NotificationController::class, 'show']);
    Route::put('/notification/update', [NotificationController::class, 'update']);
    Route::delete('/notification/delete/{id}', [NotificationController::class, 'destroy'])->middleware('IsAdmin');

    //Users
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/user/create', [UserController::class, 'store'])->middleware('IsAdmin');
    Route::get('/user/show/{id}', [UserController::class, 'show']);
    Route::put('/user/update', [UserController::class, 'update']);
    Route::delete('/user/delete/{id}', [UserController::class, 'destroy'])->middleware('IsAdmin');
});
