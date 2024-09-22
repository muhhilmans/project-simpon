<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageCivitasController;
use App\Http\Controllers\ManageSubjectController;
use App\Http\Controllers\ManageClassroomController;
use App\Http\Controllers\ManageSchoolYearController;
use App\Http\Controllers\ManageWargaBelajarController;

Route::group(['middleware' => ['role:superadmin|admin|ketua']], function () {
    Route::resource('classroom', ManageClassroomController::class)->except('create', 'edit');
    Route::post('/classroom/{classroom}/add-student', [ManageClassroomController::class, 'addStudent'])->name('classroom.addStudent');
    Route::delete('/classroom/{classroom}/remove-student', [ManageClassroomController::class, 'removeStudent'])->name('classroom.removeStudent');
    Route::resource('subject', ManageSubjectController::class)->except('create', 'edit');
    Route::resource('school-year', ManageSchoolYearController::class)->except('create', 'edit', 'show');
    Route::put('/school-year/{school_year}/status', [ManageSchoolYearController::class, 'changeStatus'])->name('school-year.status');
    Route::resource('civitas', ManageCivitasController::class)->except('create', 'edit');
    Route::resource('wargabelajar', ManageWargaBelajarController::class)->except('create', 'edit');
    Route::put('/wargabelajar/{user}/status', [ManageWargaBelajarController::class, 'changeStatus'])->name('wargabelajar.status');
});
