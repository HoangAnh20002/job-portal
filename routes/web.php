<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostJobController;
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
Route::get('/employerMain', [EmployerController::class, 'show'])->name('employerMain');
Route::get('/jobseekerMain', [JobSeekerController::class, 'show'])->name('jobseekerMain');


Route::resource('user', UserController::class);


Route::resource('employer', EmployerController::class);
Route::resource('jobseeker', JobSeekerController::class);
Route::resource('company', CompanyController::class);
Route::resource('postjob', PostJobController::class);
Route::patch('/postjob/{id}/update_status', [PostJobController::class, 'update_status'])
    ->name('postjob.update_status');
