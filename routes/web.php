<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\ComplaintController;
use App\Http\Controllers\Auth\ContentController;
use App\Http\Controllers\Auth\MasyarakatController;

// Dashboard publik
Route::get('/', [FrontendController::class, 'publicHome'])
    ->name('home_public');


// Auth society
Route::get('/user/login', [FrontendController::class, 'login'])
    ->name('user_login');

Route::post('/user/login/cek', [FrontendController::class, 'postlogin'])
    ->name('postlogin');

Route::get('/user/register', [FrontendController::class, 'register'])
    ->name('user_register');

Route::post('/user/register/save', [FrontendController::class, 'save'])
    ->name('user_register_save');

Route::get('/user/logout', [FrontendController::class, 'logout'])
    ->name('user_logout');

// Lupa Password & Reset Password
Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
    ->name('password.update');


// Dashboard setelah login
Route::get('user/home', [FrontendController::class, 'home'])->name('user_home');
Route::get('user/complaint/choose', [FrontendController::class, 'chooseVictim'])->name('choose_victim');
Route::get('user/complaint/add', [FrontendController::class, 'add_complaint'])->name('add_complaint');
Route::post('user/complaint/save', [FrontendController::class, 'save_complaint'])->name('save_complaint');
Route::get('user/complaint', [FrontendController::class, 'complaint'])->name('complaint');
Route::get('user/complaint/detail/{id}', [FrontendController::class, 'detail_complaint'])->name('detail_complaint');
Route::get('track-complaint', [FrontendController::class, 'track_complaint'])->name('track_complaint');
Route::post('search-complaint', [FrontendController::class, 'search_complaint'])->name('search_complaint');
Route::get('user/profile', [FrontendController::class, 'profile'])->name('user_profile');
Route::post('user/profile/update', [FrontendController::class, 'updateProfile'])->name('user_profile_update');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::get('/admin/login', [AdminLoginController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/admin/login', [AdminLoginController::class, 'login']);

Route::post('/logout', [AdminLoginController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth', 'checkRole:1'])
    ->prefix('admin')
    ->group(function () {

        // DASHBOARD
        Route::get(
            '/dashboard',
            [AdminDashboardController::class, 'index']
        )
            ->name('auth.admin.dashboard.index');

        Route::get(
            '/complaints',
            [ComplaintController::class, 'index']
        )
            ->name('auth.admin.pengaduan.index');

        // DETAIL
        Route::get(
            '/complaints/{complaint}',
            [ComplaintController::class, 'show']
        )
            ->name('auth.admin.pengaduan.show');

        // EDIT FORM RESPON
        Route::get(
            '/complaints/{complaint}/edit',
            [ComplaintController::class, 'edit']
        )
            ->name('auth.admin.pengaduan.edit');

        // SAVE RESPON ADMIN
        Route::post(
            '/complaints/{complaint}/save',
            [ComplaintController::class, 'save']
        )
            ->name('auth.admin.pengaduan.save');

        // UPDATE STATUS VIA BUTTON
        Route::patch(
            '/complaints/{complaint}/status/{status}',
            [ComplaintController::class, 'updateStatus']
        )
            ->name('complaints.status');

        Route::patch(
            '/complaints/{complaint}/status/{status}',
            [ComplaintController::class, 'updateStatus']
        )->name('complaints.status');

        Route::patch(
            '/complaints/{complaint}/reject',
            [ComplaintController::class, 'reject']
        )->name('complaints.reject');

        // MASYARAKAT
        Route::get('/masyarakat', [MasyarakatController::class, 'index'])
            ->name('auth.admin.masyarakat.index');

        Route::get('/masyarakat/create', [MasyarakatController::class, 'create'])
            ->name('auth.admin.masyarakat.create');

        Route::post('/masyarakat/store', [MasyarakatController::class, 'store'])
            ->name('auth.admin.masyarakat.store');

        Route::get('/masyarakat/edit/{id}', [MasyarakatController::class, 'edit'])
            ->name('auth.admin.masyarakat.edit');

        Route::post('/masyarakat/update/{id}', [MasyarakatController::class, 'update'])
            ->name('auth.admin.masyarakat.update');

        Route::get('/masyarakat/delete/{id}', [MasyarakatController::class, 'destroy'])
            ->name('auth.admin.masyarakat.delete');

        Route::get('/content', [ContentController::class, 'index'])
            ->name('auth.admin.content.index');

        Route::get('/content/create', [ContentController::class, 'create'])
            ->name('auth.admin.content.create');

        Route::post('/content/store', [ContentController::class, 'store'])
        ->name('auth.admin.content.store');

        Route::get('/content/edit/{id}', [ContentController::class, 'edit'])
            ->name('auth.admin.content.edit');
        
        Route::post('/content/update/{id}', [ContentController::class, 'update'])
            ->name('auth.admin.content.update');
        
        Route::get('/content/delete/{id}', [ContentController::class, 'destroy'])
            ->name('auth.admin.content.delete');

    });
