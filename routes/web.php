<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\EnrollmentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::resource('students', StudentController::class);
Route::resource('courses', CourseController::class);
Route::resource('teachers', TeacherController::class);
// Route::resource('enrollments', EnrollmentController::class);



Route::resource('enrollments', EnrollmentController::class)->only(['index', 'create', 'store']);

require __DIR__.'/auth.php';
