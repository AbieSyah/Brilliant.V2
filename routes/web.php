<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');
