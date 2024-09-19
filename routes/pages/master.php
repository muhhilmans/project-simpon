<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageCivitasController;
use App\Http\Controllers\ManageSchoolYearController;
use App\Http\Controllers\ManageWargaBelajarController;

Route::group(['middleware' => ['role:superadmin|admin']], function () {
    Route::resource('school-year', ManageSchoolYearController::class)->except('create', 'edit', 'show');
    Route::put('/school-year/{school_year}/status', [ManageSchoolYearController::class, 'changeStatus'])->name('school-year.status');
    Route::resource('civitas', ManageCivitasController::class)->except('create', 'edit');
    Route::resource('wargabelajar', ManageWargaBelajarController::class)->except('create', 'edit');
    Route::put('/wargabelajar/{user}/status', [ManageWargaBelajarController::class, 'changeStatus'])->name('wargabelajar.status');
});