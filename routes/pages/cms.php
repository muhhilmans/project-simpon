<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('cms.index');
    })->name('dashboard');
});
