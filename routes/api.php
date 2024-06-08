<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostJobController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/applications', ApplicationController::class);
Route::resource('/services',ServiceController::class);
Route::patch('/application/update-status/{application}',[ApplicationController::class,'updateStatus']);

Route::get('/filter-postjob',[PostJobController::class,'filterStatus']);
Route::resource('/payment-test', PaymentController::class);
