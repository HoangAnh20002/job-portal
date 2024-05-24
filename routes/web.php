<?php

use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::get('/login', [\App\Http\Controllers\LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class,'login']);
Route::get('/logout',[\App\Http\Controllers\LoginController::class,'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

Route::get('/adminMain', [UserController::class, 'index_ad'])->name('adminMain');
Route::get('/employerMain', [UserController::class, 'index_employer'])->name('employerMain');
Route::get('/jobseekerMain', [UserController::class, 'index_jobseeker'])->name('jobseekerMain');


Route::resource('users', UserController::class);
Route::get('adminMain/employer',[UserController::class,'employer'])->name('user.employer');
Route::get('adminMain/jobseeker',[UserController::class,'jobseeker'])->name('user.jobseeker');
Route::resource('employers', EmployerController::class);
Route::resource('jobseekers', JobSeekerController::class);
