<?php

use App\Livewire\Home;
use App\Livewire\PaketPengerjaan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});


Route::middleware([

]);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/', Home::class)->name('home');
    Route::get('/paket-pengerjaan', PaketPengerjaan::class)->name('paket-pengerjaan');
});