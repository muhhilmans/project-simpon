<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageTaskController;
use App\Http\Controllers\ManageGradeController;
use App\Http\Controllers\ManageMaterialController;

Route::group(['middleware' => ['role:superadmin|admin|ketua|tutor']], function () {
    Route::resource('material', ManageMaterialController::class)->except('create', 'edit');
    Route::resource('task', ManageTaskController::class)->except('create', 'edit');
    Route::resource('grade', ManageGradeController::class)->except('create', 'edit');
});
