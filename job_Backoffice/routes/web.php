<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\JobVacancyController;
use App\Http\Controllers\JobCategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth')->group(function () {
    Route::get('/',[DashboardController::class, 'index'])->name('dashboard');
    Route::get('/companies',[CompanyController::class, 'index'])->name('company.index');
    Route::get('/jobApplications',[JobApplicationController::class, 'index'])->name('application.index');
    Route::get('/jobVacancies',[JobVacancyController::class, 'index'])->name('job-vacancy.index');
    Route::get('/jobCategories',[JobCategoryController::class, 'index'])->name('category.index');
    Route::get('/users',[UserController::class, 'index'])->name('user.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
