<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// Redirect root to register page (instead of login)
Route::redirect('/', '/register');

// =====================
// AUTH ROUTES
// =====================
// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);


// =====================
// PROTECTED ROUTES
// =====================
Route::middleware('auth')->group(function () {

    // General Dashboard (for everyone after login)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // =====================
    // ADMIN ROUTES
    // =====================
    Route::middleware('role:admin')->group(function () {
        // Admin Dashboard
        Route::get('/admin/dashboard', function () {
            return view('admin.admin_dashboard');
        })->name('admin.dashboard');

        Route::get('/users', function () { return 'Admin: Users list'; })->name('users.index');
        Route::get('/users/create', function () { return 'Admin: Add User Form'; })->name('users.create');
        Route::get('/reports', function () { return 'Admin: Reports Page'; })->name('reports.index');
    });

    // =====================
    // INSTRUCTOR ROUTES
    // =====================
    Route::middleware('role:instructor')->group(function () {
        Route::get('/instructor/dashboard', function () {
            return view('instructor.instructor_dashboard');
        })->name('instructor.dashboard');
    });

    // =====================
    // STUDENT ROUTES
    // =====================
    Route::middleware('role:student')->group(function () {
    Route::get('/student/dashboard', function () {
        return view('student.student_dashboard');
    })->name('student.dashboard');
});


});
