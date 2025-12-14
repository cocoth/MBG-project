<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::name('home.')->group(function () {
    Route::get('/', function () {
        return view('index');
    })->name('index');
    Route::get('/about', function () {
        return view('about');
    })->name('about');
    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');
});

// Authentication Routes
Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('/signin', [AuthController::class, 'showSigninForm'])->name('signin');
    Route::post('/signin', [AuthController::class, 'signin'])->name('signin.post');
    Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
    Route::post('/signup', [AuthController::class, 'signup'])->name('signup.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::get('/login', [AuthController::class, 'showSigninForm'])->name('login');


// Admin Routes
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', function () {
        return view('admin.profile');
    })->name('profile');

    Route::get('/admin-management', function () {
        return view('admin.admin-management');
    })->name('admin-management');

    Route::get('/create-votes', function () {
        return view('admin.create-votes');
    })->name('create-votes');

    Route::get('/view-votes', function () {
        return view('admin.view-votes');
    })->name('view-votes');
});

// User Routes
Route::prefix('user')->middleware(['auth', 'role:user'])->name('user.')->group(function () {
    Route::get('/', function () {
        return view('user.dashboard');
    })->name('dashboard');
    Route::get('/profile', [UserController::class, 'currentUser'])->name('profile');
    Route::get('/votes', function () {
        return view('votes');
    })->name('votes');
});
