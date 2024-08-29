<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

require __DIR__ . '/pages/auth.php';
require __DIR__ . '/pages/cms.php';