<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

/*
|--------------------------------------------------------------------------
| CONTROLLER
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserApprovalController;
use App\Http\Controllers\Auth\ComplaintController;
use App\Http\Controllers\Auth\ContentController;
use App\Http\Controllers\Auth\MasyarakatController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/

Route::get('/', [FrontendController::class, 'publicHome'])->name('home_public');

/*
|--------------------------------------------------------------------------
| USER AUTH
|--------------------------------------------------------------------------
*/
Route::prefix('user')->group(function () {

    Route::get('/login', [FrontendController::class, 'login'])->name('user_login');
    Route::post('/login', [FrontendController::class, 'postlogin'])->name('postlogin');

    Route::get('/register', [FrontendController::class, 'register'])->name('user_register');
    Route::post('/register/save', [FrontendController::class, 'save'])->name('user_register_save');

    Route::get('/logout', [FrontendController::class, 'logout'])->name('user_logout');
});

/*
|--------------------------------------------------------------------------
| FORGOT PASSWORD USER
|--------------------------------------------------------------------------
*/
Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])
    ->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [PasswordResetController::class, 'resetPassword'])
    ->name('password.update');

/*
|--------------------------------------------------------------------------
| USER AREA (SETELAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::prefix('user')->group(function () {

    Route::get('/home', [FrontendController::class, 'home'])->name('user_home');

    Route::get('/complaint', [FrontendController::class, 'complaint'])->name('complaint');
    Route::get('/complaint/add', [FrontendController::class, 'add_complaint'])->name('add_complaint');
    Route::post('/complaint/save', [FrontendController::class, 'save_complaint'])->name('save_complaint');

    Route::get('/complaint/detail/{id}', [FrontendController::class, 'detail_complaint'])->name('detail_complaint');

    Route::get('/complaint/choose', [FrontendController::class, 'chooseVictim'])->name('choose_victim');

    Route::get('/profile', [FrontendController::class, 'profile'])->name('user_profile');
    Route::post('/profile/update', [FrontendController::class, 'updateProfile'])->name('user_profile_update');
});

/*
|--------------------------------------------------------------------------
| TRACK COMPLAINT
|--------------------------------------------------------------------------
*/
Route::get('/track-complaint', [FrontendController::class, 'track_complaint'])->name('track_complaint');
Route::post('/search-complaint', [FrontendController::class, 'search_complaint'])->name('search_complaint');

/*
|--------------------------------------------------------------------------
| ADMIN AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::prefix('admin')->group(function () {

    Route::get('/login', [AdminLoginController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login']);
});

Route::get('/admin/register', function () {
    return view('auth.admin.register');
})->name('admin.register');

Route::post('/admin/register', [AdminLoginController::class, 'registerAdmin'])
    ->name('admin.register.save');

/*
|--------------------------------------------------------------------------
| LOGOUT GLOBAL
|--------------------------------------------------------------------------
*/
Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');

/*
| ADMIN FORGOT PASSWORD 
|--------------------------------------------------------------------------
*/
Route::get('/admin/forgot-password', [PasswordResetController::class, 'showForgotAdmin'])
    ->name('admin.password.request');

Route::post('/admin/forgot-password', [PasswordResetController::class, 'sendResetLinkAdmin'])
    ->name('admin.password.email');

Route::get('/admin/reset-password/{token}', [PasswordResetController::class, 'showResetAdmin'])
    ->name('admin.password.reset');

Route::post('/admin/reset-password', [PasswordResetController::class, 'resetAdmin'])
    ->name('admin.password.update');


Route::prefix('admin')->group(function () {

    Route::get('/approval', [UserApprovalController::class, 'index'])
        ->name('admin.approval');

    Route::get('/approve/{id}', [UserApprovalController::class, 'approve'])
        ->name('admin.approve');

    Route::get('/reject/{id}', [UserApprovalController::class, 'reject'])
        ->name('admin.reject');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA (PROTECTED)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'checkRole:admin'])
    ->prefix('admin')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('auth.admin.dashboard.index');

        Route::get('/approval', [UserApprovalController::class, 'index'])
            ->name('auth.admin.approval');

        // ✅ INI YANG KURANG
        Route::post('/approve/{id}', [UserApprovalController::class, 'approve'])
            ->name('admin.approve');

        Route::post('/reject/{id}', [UserApprovalController::class, 'reject'])
            ->name('admin.reject');

        /*
        |--------------------------------------------------------------------------
        | COMPLAINT
        |--------------------------------------------------------------------------
        */
        Route::get('/complaints', [ComplaintController::class, 'index'])
            ->name('auth.admin.pengaduan.index');

        Route::get('/complaints/{complaint}', [ComplaintController::class, 'show'])
            ->name('auth.admin.pengaduan.show');

        Route::get('/complaints/{complaint}/edit', [ComplaintController::class, 'edit'])
            ->name('auth.admin.pengaduan.edit');

        Route::post('/complaints/{complaint}/save', [ComplaintController::class, 'save'])
            ->name('auth.admin.pengaduan.save');

        Route::patch('/complaints/{complaint}/status/{status}', [ComplaintController::class, 'updateStatus'])
            ->name('complaints.status');

        Route::patch('/complaints/{complaint}/reject', [ComplaintController::class, 'reject'])
            ->name('complaints.reject');

        /*
        |--------------------------------------------------------------------------
        | MASYARAKAT
        |--------------------------------------------------------------------------
        */
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

        /*
        |--------------------------------------------------------------------------
        | CONTENT
        |--------------------------------------------------------------------------
        */
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
