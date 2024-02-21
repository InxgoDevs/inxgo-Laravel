<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\FcmTokenController;


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
// routes/web.php
//Route::resource('services', ServiceController::class);
//Route::resource('skills', SkillController::class);
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Manage Users
    Route::get('/admin/users', [AdminController::class, 'showUsers'])->name('admin.users.index');
    Route::get('/admin/users/create', [AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/admin/users/{user}/edit', [AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');

    // Manage Services
    Route::get('/admin/services', [AdminController::class, 'showServices'])->name('admin.services.index');
    Route::get('/admin/services/create', [AdminController::class, 'createService'])->name('admin.services.create');
    Route::post('/admin/services', [AdminController::class, 'storeService'])->name('admin.services.store');
    Route::get('/admin/services/{service}/edit', [AdminController::class, 'editService'])->name('admin.services.edit');
    Route::put('/admin/services/{service}', [AdminController::class, 'updateService'])->name('admin.services.update');
    Route::delete('/admin/services/{service}', [AdminController::class, 'destroyService'])->name('admin.services.destroy');

    // Manage Skills
Route::get('/admin/skills', [AdminController::class, 'showSkills'])->name('admin.skills.index');
    Route::get('/admin/skills/create', [AdminController::class, 'createSkill'])->name('admin.skills.create');
    Route::post('/admin/skills', [AdminController::class, 'storeSkill'])->name('admin.skills.store');
    Route::get('/admin/skills/{skill}/edit', [AdminController::class, 'editSkill'])->name('admin.skills.edit');
    Route::put('/admin/skills/{skill}', [AdminController::class, 'updateSkill'])->name('admin.skills.update');
    Route::delete('/admin/skills/{skill}', [AdminController::class, 'destroySkill'])->name('admin.skills.destroy');
});
 



Auth::routes();
// routes/web.php

// Dashboard routes
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
// routes/web.php

Route::middleware(['auth', 'role:seller'])->group(function () {
    Route::get('/seller/dashboard', [SellerDashboardController::class, 'index'])->name('seller.dashboard');
});

// ... other routes


Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', [ClientDashboardController::class, 'index'])->name('client.dashboard');
});


///Route::get('/user', [UserController::class, 'getUser'])->name('user.profile.show');



Route::get('/user/profile', [UserController::class, 'showProfile'])->name('user.profile.show');
Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
Route::put('/user/profile/update', [UserController::class, 'updateProfile'])->name('user.profile.update');


Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');


// Define routes for Jobs
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
Route::get('/jobs/{job}', [JobController::class, 'show'])->name('jobs.show');
Route::get('/jobs/{job}/edit', [JobController::class, 'edit'])->name('jobs.edit');
Route::put('/jobs/{job}', [JobController::class, 'update'])->name('jobs.update');
Route::delete('/jobs/{job}', [JobController::class, 'destroy'])->name('jobs.destroy');
Route::get('/jobs/assigned', [JobController::class, 'assigned'])->name('jobs.assigned');
Route::get('/jobs/in_progress', [JobController::class, 'inProgress'])->name('jobs.in_progress');
Route::get('/jobs/completed', [JobController::class, 'completed'])->name('jobs.completed');
Route::get('/jobs/payment_being_cleared', [JobController::class, 'paymentBeingCleared'])->name('jobs.payment_being_cleared');

