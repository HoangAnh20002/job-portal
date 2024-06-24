<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\interface\HomeController;
use App\Http\Controllers\JobSeekerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\ServiceController;
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

// Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');

// Route::get('/login', [\App\Http\Controllers\LoginController::class,'showLoginForm'])->name('login');
// Route::post('/login', [\App\Http\Controllers\LoginController::class,'login']);
// Route::get('/logout',[\App\Http\Controllers\LoginController::class,'logout'])->name('logout');
// Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
// Route::post('/register', [LoginController::class, 'register']);

// Route::get('/adminMain', [UserController::class, 'index_ad'])->name('adminMain');
// Route::get('/employerMain', [EmployerController::class, 'show'])->name('employerMain');
// Route::get('/jobseekerMain', [JobSeekerController::class, 'show'])->name('jobseekerMain');

// Route::resource('user', UserController::class);
// // Routes cho jobseeker
// Route::resource('jobseeker', JobseekerController::class);
// Route::resource('employer', EmployerController::class);
// // Route::middleware(['auth', 'checkAccess'])->group(function () {


// //     Route::get('/jobseeker/create', [JobseekerController::class, 'create'])->name('jobseeker.create');
// //     Route::post('/jobseeker', [JobseekerController::class, 'store'])->name('jobseeker.store');

// //     // Routes cho employer

// //     Route::get('/employer/create', [EmployerController::class, 'create'])->name('employer.create');
// //     Route::post('/employer', [EmployerController::class, 'store'])->name('employer.store');
// // });

// Route::resource('company', CompanyController::class);
// Route::resource('postjob', PostJobController::class);
// Route::patch('/postjob/{id}/update_status', [PostJobController::class, 'update_status'])->name('postjob.update_status');

// Route::get('/create-payment', [VNpayController::class, 'create']);
// Route::get('/return-vnpay', [VNpayController::class, 'return']);

// //Application
// Route::resource('/', ApplicationController::class);
// Route::patch('/application/update-status/{application}',[ApplicationController::class,'updateStatus']);


// //Service

// Route::resource('services',ServiceController::class)->names('servicesroute1');

Route::get('/', [\App\Http\Controllers\interface\HomeController::class,'index'])->name('home');
//Route::post('/search', [HomeController::class, 'search'])->name('home.search');
Route::get('/postjob/search',[PostJobController::class,'searchTitleJob'])->name('home.search');

Route::get('/login', [\App\Http\Controllers\LoginController::class,'showLoginForm'])->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class,'login']);
Route::get('/logout',[\App\Http\Controllers\LoginController::class,'logout'])->name('logout');
Route::get('/register', [LoginController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);
Route::get('/postjobs/{id}', [PostJobController::class, 'showPublic'])->name('showPublic');
Route::post('/store', [ApplicationController::class, 'store'])->name('application-store');
Route::middleware(['auth'])->group(function () {
    Route::get('/adminMain', [UserController::class, 'index_ad'])->middleware('checkAdmin')->name('adminMain');
    Route::get('/admin/search-employer',[UserController::class,'searchEmployers'])->name('searchEmployers')->middleware('checkAdmin');
    Route::get('/admin/search-jobseeker',[UserController::class,'searchJobSeekers'])->name('searchJobSeekers')->middleware('checkAdmin');
    Route::get('/employerMain', [EmployerController::class, 'show'])->middleware('checkEmployer')->name('employerMain');
    Route::get('/jobseekerMain', [JobSeekerController::class, 'show'])->middleware('checkJobSeeker')->name('jobseekerMain');

    Route::resource('user', UserController::class);
    Route::get('/my/payment',[UserController::class,'showMyPayment'])->name('showMyPayment');

    // Routes cho jobseeker
    Route::resource('jobseeker', JobseekerController::class);
    Route::get('jobseeker', [JobseekerController::class, 'index'])->name('jobseeker.index')->middleware(['checkAdmin']);
    Route::resource('employer', EmployerController::class);

    Route::resource('company', CompanyController::class)->middleware('checkAdmin');
    Route::resource('postjob', PostJobController::class)->middleware('checkAdmin')->middleware('checkEmployer');
    Route::patch('/postjob/{id}/update_status', [PostJobController::class, 'update_status'])->name('postjob.update_status');

    Route::get('/create-payment', [VNpayController::class, 'create']);
    Route::get('/return-vnpay', [VNpayController::class, 'return']);

    // Application
    Route::resource('application', ApplicationController::class);
    Route::put('/application/{application}/updateStatus', [ApplicationController::class, 'updateStatus'])->name('application.updateStatus');

    // Service
    Route::resource('services', ServiceController::class)->names('servicesroute');

    //VNPAY
    // Route::get('/create-payment', [VNpayController::class, 'create']);
    Route::get('create-payment', [VNpayController::class, 'create'])->name('createPayment');

    Route::get('/return-vnpay', [VNpayController::class, 'return']);
    //Get all apply
    Route::get('/get-my-apply',[UserController::class,'showApply'])->name('showApply');
// Trong file routes/web.php
    Route::view('/test-vn', 'testvnPay'); // Chỉ cần tên view không cần đuôi .blade.php

    //Search job
    Route::get('/filter-postjob',[PostJobController::class,'filterStatus'])->name('filterStatus')->middleware('checkAdmin');
    Route::resource('/payment', PaymentController::class)->names('payment');
    Route::get('/payment-all',[PaymentController::class,'showAllPayment'])->middleware('checkAdmin')->name('paymentAll');
});

Route::get('/show-user-apply',[ApplicationController::class,'showUserApply'])->name('application.showUserApply');
