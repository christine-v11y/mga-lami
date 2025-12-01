<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserManagementController;

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

       Route::get('/admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');

       Route::get('/admin/users/create', [UserManagementController::class, 'create'])->name('admin.users.create');
       Route::post('/admin/users', [UserManagementController::class, 'store'])->name('admin.users.store');

       Route::get('/admin/users/{id}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit'); 
       Route::put('/admin/users/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');

       Route::delete('/admin/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');
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
