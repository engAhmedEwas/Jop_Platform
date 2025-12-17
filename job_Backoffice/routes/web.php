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

    Route::resource('/companies', CompanyController::class);
    Route::PUT('/companies/{id}/restore',[CompanyController::class, 'restore'])->name('companies.restore');

    Route::resource('/job-applications', JobApplicationController::class);
    Route::PUT('/jobApplications/{id}/restore',[JobApplicationController::class, 'restore'])->name('job-applications.restore');

    Route::resource('/job-vacancies', JobVacancyController::class);
    Route::PUT('/jobVacancies/{id}/restore',[JobVacancyController::class, 'restore'])->name('job-vacancies.restore');
    // Route::get('/jobVacancies',[JobVacancyController::class, 'index'])->name('job-vacancy.index');

    Route::resource('/job-categories', JobCategoryController::class);
    Route::PUT('/job-categories/{id}/restore',[JobCategoryController::class, 'restore'])->name('job-categories.restore');

    Route::resource('/users', UserController::class);
    // Route::get('/users',[UserController::class, 'index'])->name('user.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
