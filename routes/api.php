<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use App\Models\Course_details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
    Route::post('register' , [AuthController::class , 'register']);
    Route::post('login' , [AuthController::class , 'login']);
    Route::post('logout' , [AuthController::class , 'logout']);
    
Route::get('users' , [UserController::class , 'all']);
Route::post('profile' , [UserController::class , 'profile']);
Route::post('add_course/{id}' , [UserController::class , 'add_course']);
    

Route::get('answers/{id}/{course_id}' , [AnswerController::class , 'all']);
Route::get('answer/show/{id}' , [AnswerController::class , 'show']);
Route::post('answers/create' , [AnswerController::class , 'create']);
Route::get('answer/delete/{id}' , [AnswerController::class , 'delete']);



Route::get('admin/profile/{id}' , [AdminController::class , 'profile']);


Route::controller(CategoryController::class)->group(function(){
    Route::get('categories' , 'all');
    Route::get('category/show/{id}' , 'show');
    Route::post('categories/create' , 'create');
    Route::post('categories/update/{id}' , 'update');
    Route::get('categories/delete/{id}' , 'delete');
});


Route::get('courses' , [CourseController::class , 'all']);
Route::get('course/show/{id}' , [CourseController::class , 'show']);
Route::post('courses/create' , [CourseController::class , 'create']);
Route::post('courses/update/{id}' , [CourseController::class , 'update']);
Route::get('courses/delete/{id}' , [CourseController::class , 'delete']);

Route::get('contacts' , [ContactController::class , 'all']);
Route::get('contact/show/{id}' , [ContactController::class , 'show']);
Route::post('contacts/create' , [ContactController::class , 'create']);
Route::post('contacts/update/{id}' , [ContactController::class , 'update']);
Route::get('contacts/delete/{id}' , [ContactController::class , 'delete']);

Route::get('settings' , [SettingController::class , 'all']);
Route::get('setting/show/{id}' , [SettingController::class , 'show']);
Route::post('settings/create' , [SettingController::class , 'create']);
Route::post('settings/update/{id}' , [SettingController::class , 'update']);
Route::get('settings/delete/{id}' , [SettingController::class , 'delete']);

Route::get('instructors' , [InstructorController::class , 'all']);
Route::get('instructor/show/{id}' , [InstructorController::class , 'show']);
Route::post('instructors/create' , [InstructorController::class , 'create']);
Route::get('instructor/{id}' , [InstructorController::class , 'updateStatus']);
Route::post('instructors/update/{id}' , [InstructorController::class , 'update']);
Route::get('instructors/delete/{id}' , [InstructorController::class , 'delete']);

Route::get('quizes/{id}' , [QuizController::class , 'all']);
Route::get('quizes/questions' , [QuizController::class , 'questions']);
Route::get('quiz/show/{id}' , [QuizController::class , 'show']);
Route::post('quizes/create' , [QuizController::class , 'create']);
Route::post('quizes/update/{id}' , [QuizController::class , 'update']);
Route::get('quizes/delete/{id}' , [QuizController::class , 'delete']);

Route::get('videos/{id}' , [VideoController::class , 'all']);
Route::get('video/show/{id}' , [VideoController::class , 'show']);
Route::post('videos/create' , [VideoController::class , 'create']);
Route::post('videos/update/{id}' , [VideoController::class , 'update']);
Route::get('videos/delete/{id}' , [VideoController::class , 'delete']);



Route::get('comments/{id}' , [CommentController::class , 'all']);
Route::get('comment/show/{id}' , [CommentController::class , 'show']);
Route::post('comments/create/{id}' , [CommentController::class , 'create']);
Route::get('comments/delete/{id}' , [CommentController::class , 'delete']);


