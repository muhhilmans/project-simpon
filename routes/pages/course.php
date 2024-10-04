<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ManageTaskController;
use App\Http\Controllers\ManageGradeController;
use App\Http\Controllers\ManageChapterMaterialController;
use App\Http\Controllers\ManageSubChapterMaterialController;

Route::group(['middleware' => ['role:superadmin|admin|ketua|tutor']], function () {
    Route::resource('chapter', ManageChapterMaterialController::class)->except('create', 'edit');
    Route::resource('sub-chapter', ManageSubChapterMaterialController::class)->except('create', 'edit');
    Route::resource('task', ManageTaskController::class)->except('create', 'edit');
    Route::resource('grade', ManageGradeController::class)->except('create', 'edit');
});
