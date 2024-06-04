<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VNpayController;
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

Route::middleware(['auth', 'checkAccess'])->group(function () {
    // Routes cho jobseeker
    Route::resource('jobseeker', JobseekerController::class)->except(['create', 'store']);
    Route::get('/jobseeker/create', [JobseekerController::class, 'create'])->name('jobseeker.create');
    Route::post('/jobseeker', [JobseekerController::class, 'store'])->name('jobseeker.store');

    // Routes cho employer
    Route::resource('employer', EmployerController::class)->except(['create', 'store']);
    Route::get('/employer/create', [EmployerController::class, 'create'])->name('employer.create');
    Route::post('/employer', [EmployerController::class, 'store'])->name('employer.store');
});

Route::resource('company', CompanyController::class);
Route::resource('postjob', PostJobController::class);
Route::patch('/postjob/{id}/update_status', [PostJobController::class, 'update_status'])->name('postjob.update_status');

Route::get('/create-payment', [VNpayController::class, 'create']);
Route::get('/return-vnpay', [VNpayController::class, 'return']);
