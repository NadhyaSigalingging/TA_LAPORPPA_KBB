<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PasswordResetController;

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