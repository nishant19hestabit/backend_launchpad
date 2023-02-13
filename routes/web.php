<?php

use App\Http\Controllers\CommandController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RandomController;
use App\Models\EmailRecord;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/quote', [RandomController::class, 'index']);

Route::get('/', [LoginController::class, 'index']);
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/login', [LoginController::class, 'loginCheck']);
Route::group(['middleware' => ['auth', 'prevent']], function () {
    Route::get('/logout', [LoginController::class, 'logout']);
    Route::get('/schedule-command', [CommandController::class, 'index']);
    Route::post('/command-save', [CommandController::class, 'store']);
});
