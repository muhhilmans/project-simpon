<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('cms.index');
})->name('dashboard');

Route::get('/candidate', function () {
    return view('cms.pages.candidate.index');
})->name('candidate');

Route::group(['middleware' => ['role:superadmin|admin']], function () {
    Route::resource('users', UserController::class);
});
