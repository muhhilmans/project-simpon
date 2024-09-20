<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__ . '/pages/auth.php';

Route::group(['middleware' => 'auth'], function () {
    require __DIR__ . '/pages/cms.php';
    require __DIR__ . '/pages/course.php';
    require __DIR__ . '/pages/master.php';
});