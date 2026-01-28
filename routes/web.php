<?php

use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\StudentViolationController;
use App\Http\Controllers\Admin\ViolationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\StudentSearchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes (No Auth Required)
|--------------------------------------------------------------------------
*/

// Home Page - Public Landing
Route::get('/', [HomeController::class, 'index'])->name('home');

// Leaderboard - Public
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

// Student Search - For Parents
Route::get('/student-search', [StudentSearchController::class, 'index'])->name('student.search');
Route::post('/student-search', [StudentSearchController::class, 'search'])->name('student.search.post');

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Routes (Auth + Admin Role Required)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/violations-chart', [DashboardController::class, 'getViolationsChartData'])->name('dashboard.violations-chart');

    // Class Management
    Route::resource('classes', ClassController::class);

    // Student Management
    Route::resource('students', StudentController::class);

    // Violation Type Management
    Route::resource('violations', ViolationController::class);

    // Student Violation Records
    Route::resource('student-violations', StudentViolationController::class);
    Route::get('/violations-history', [StudentViolationController::class, 'history'])->name('violations.history');

    // Fine & Point Reset
    Route::get('/fines', [StudentViolationController::class, 'fines'])->name('fines.index');
    Route::post('/fines/reset-all', [StudentViolationController::class, 'resetAllPoints'])->name('fines.reset-all');
    Route::post('/fines/{student}/reset', [StudentViolationController::class, 'resetPoints'])->name('fines.reset');

    // Reward Management
    Route::resource('rewards', RewardController::class);
    Route::get('/rewards/eligible/list', [RewardController::class, 'eligible'])->name('rewards.eligible');

    // Application Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');
});
