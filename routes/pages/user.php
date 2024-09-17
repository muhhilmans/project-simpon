<?php

use App\Http\Controllers\ManageWargaBelajarController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['role:superadmin|admin']], function () {
    Route::resource('wargabelajar', ManageWargaBelajarController::class)->except('create', 'edit');
});
