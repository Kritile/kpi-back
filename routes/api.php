<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\PageController;
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
Route::controller(UserController::class)->prefix('/user')->group(function () {
    Route::middleware('auth:sanctum')->get('/', function (Request $request) {
        return $request->user();
    });
    Route::post('/create', 'register');
    Route::post('/login', 'login');
    Route::get('/check', 'checkAuth');
});

//courses
Route::prefix('/courses')->group(function () {
    Route::get('page/{page}', [CourseController::class,'getAllCourse']);
    Route::get('/{id}', [CourseController::class,'getCourse']);
    Route::middleware('auth:sanctum')->post('/create',[CourseController::class,'createCourse']);
    Route::get('/{course_id}/lessons/', [LessonController::class,'getLessonsList']);
    Route::middleware('auth:sanctum')->post('/{course_id}/lessons', [LessonController::class,'createLesson']);
    Route::middleware('auth:sanctum')->put('/{course_id}/lessons', [LessonController::class,'editLesson']);
    Route::middleware('auth:sanctum')->delete('/lesson/{id}', [LessonController::class,'removeLesson']);
});
//pages

Route::get('/about', [PageController::class,'getAbout']);
Route::get('/contacts', [PageController::class,'getContacts']);
