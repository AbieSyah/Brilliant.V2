<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ReviewCrud;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');

Route::get('/reviews-admin', ReviewCrud::class)->name('reviews.admin');
