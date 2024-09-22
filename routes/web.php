<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::fallback(function () {
    $data = new \stdClass();
    $data->message = 'Halaman tidak ditemukan!';

    return view('error', compact('data'));
});


require __DIR__ . '/pages/auth.php';

Route::group(['middleware' => 'auth'], function () {
    require __DIR__ . '/pages/cms.php';
    require __DIR__ . '/pages/course.php';
    require __DIR__ . '/pages/master.php';
});