<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\TenantController;
use App\Http\Controllers\Admin\ApproveUserController;

Route::get('verify/email/{id}', [VerifyEmailController::class, 'verifyEmail'])->name('verify_email');
Route::get('/', [LoginController::class, 'LoginForm'])->name('loginPage');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::middleware(['auth:sanctum', 'checkRole:admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::get('/landlord', [DashboardController::class, 'getLandlord'])->name('admin.landlord');
    Route::get('/visitor', [DashboardController::class, 'getVisitor'])->name('admin.visitor');
    Route::get('/service/provider', [DashboardController::class, 'getServiceProvider'])->name('admin.service_provider');
    Route::get('/tenant', [DashboardController::class, 'getTenant'])->name('admin.tenant');
    Route::get('/properties/{id}', [PropertyController::class, 'getLandlord'])->name('admin.properties');
    Route::get('/service/{id}', [ServiceController::class, 'getService'])->name('admin.services');
    Route::get('/tenants/{id}', [TenantController::class, 'getTenant'])->name('admin.tenants');
    Route::get('approve/user/{id}',[ApproveUserController::class,'approveUser'])->name('approve.service_provider');

});
