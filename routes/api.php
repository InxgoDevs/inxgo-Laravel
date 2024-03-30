<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ServiceApiController;
use App\Http\Controllers\API\SkillApiController;
use App\Http\Controllers\API\ClientDashboardApiController;
use App\Http\Controllers\API\SellerDashboardApiController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\WalletController;

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

Route::post('/register', [AuthController::class, 'signup']);
Route::post('/signin', [AuthController::class, 'signin']);
Route::middleware('auth:sanctum')->get('/user', [AuthController::class, 'getUser']);

//Get ALL SERVICES

Route::get('/services', [ServiceApiController::class, 'index']);

// Get ALL SKILLS

Route::get('/skills', [SkillApiController::class, 'index']);

 // Client Dashboard API routes

Route::middleware('auth:sanctum')->group(function () {
   
    Route::get('/client-dashboard/skills', [ClientDashboardApiController::class, 'getAllSkills']);
    Route::get('/client-dashboard/active-job-cards', [ClientDashboardApiController::class, 'getActiveJobCards']);
    Route::get('/client-dashboard/most-recent-job-card', [ClientDashboardApiController::class, 'getMostRecentJobCard']);
    Route::get('/client-dashboard/nearby-sellers', [ClientDashboardApiController::class, 'getNearbySellers']);
});

// Seller Dashboard API routes
Route::middleware(['auth:sanctum', 'role:seller'])->group(function () {
    Route::get('/seller-dashboard', [SellerDashboardApiController::class, 'index']);
});
// routes/web.php or routes/api.php
Route::post('/send-job-request', 'ClientDashboardController@sendJobRequest');



Route::any('/myjob', [JobController::class, 'myjob']);
Route::any('/job', [JobController::class, 'store']);
Route::any('/job/assign', [JobController::class, 'assign']);
Route::any('/job/status', [JobController::class, 'status']);

Route::any('/wallet', [WalletController::class, 'store']);
Route::any('/wallet/seller', [WalletController::class, 'seller']);
Route::any('/wallet/buyer', [WalletController::class, 'buyer']);
