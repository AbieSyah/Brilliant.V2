<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ReviewCrud;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/galeri', function () {
    return view('galeri');
})->name('galeri');

Route::get('/reviews-admin', ReviewCrud::class)->name('reviews.admin');
