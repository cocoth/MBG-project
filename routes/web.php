<?php

use App\Http\Controllers\AdminManagementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\VoteController;
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

    // Admin Management Routes
    Route::get('/admin-management', [AdminManagementController::class, 'index'])->name('admin-management.index');
    Route::get('/admin-management/create', [AdminManagementController::class, 'create'])->name('admin-management.create');
    Route::post('/admin-management', [AdminManagementController::class, 'store'])->name('admin-management.store');
    Route::get('/admin-management/{admin}/edit', [AdminManagementController::class, 'edit'])->name('admin-management.edit');
    Route::put('/admin-management/{admin}', [AdminManagementController::class, 'update'])->name('admin-management.update');
    Route::delete('/admin-management/{admin}', [AdminManagementController::class, 'destroy'])->name('admin-management.destroy');

    // Menu Management Routes
    Route::get('/create-votes', [MenuController::class, 'create'])->name('create-votes');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/view-votes', [MenuController::class, 'index'])->name('view-votes');
    Route::get('/menus/{menu}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{menu}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{menu}', [MenuController::class, 'destroy'])->name('menus.destroy');
    Route::patch('/menus/{menu}/toggle', [MenuController::class, 'toggleActive'])->name('menus.toggle');
});

// User Routes
Route::prefix('user')->middleware(['auth', 'role:user'])->name('user.')->group(function () {
    Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'currentUser'])->name('profile');
    Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');

    // Voting Routes
    Route::get('/menus', [VoteController::class, 'allMenus'])->name('menus');
    Route::post('/votes/{menu}', [VoteController::class, 'vote'])->name('votes.cast');
    Route::get('/vote-history', [VoteController::class, 'history'])->name('vote-history');

    // Backward compatibility alias for old route
    Route::get('/votes', [VoteController::class, 'allMenus'])->name('votes');
});
