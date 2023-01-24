<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Models\About;
use \App\Models\Contacts;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//user
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/user-check', [UserController::class, 'checkAuth']);
Route::post('/create-user',[UserController::class,'login']);
Route::post('/register-user',[UserController::class,'register']);
Route::post('/login-user',[UserController::class,'login']);
//courses
Route::get('/courses/{page}', [CourseController::class,'getAllCourse']);
Route::get('/course/{id}', [CourseController::class,'getCourse']);
Route::middleware('auth:sanctum')->post('/create-course', [CourseController::class,'createCourse']);
//lessons
Route::get('/lessons/{course_id}', [LessonController::class,'getLessonsList']);
Route::middleware('auth:sanctum')->post('/create-lesson', [LessonController::class,'createLesson']);
Route::middleware('auth:sanctum')->post('/remove-lesson', [LessonController::class,'removeLesson']);
//pages
Route::get('/about', function (){
    return About::first();
});
Route::get('/contacts', function (){
    return Contacts::first();
});
