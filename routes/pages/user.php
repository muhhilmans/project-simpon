<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageCivitasController;
use App\Http\Controllers\ManageWargaBelajarController;

Route::group(['middleware' => ['role:superadmin|admin']], function () {
    Route::resource('civitas', ManageCivitasController::class)->except('create', 'edit');
    Route::resource('wargabelajar', ManageWargaBelajarController::class)->except('create', 'edit');
    Route::put('/wargabelajar/{user}/status', [ManageWargaBelajarController::class, 'changeStatus'])->name('wargabelajar.status');
});
