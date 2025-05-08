<?php

use App\Livewire\Home;
use App\Livewire\Checklist;
use App\Livewire\Reservasi;
use App\Livewire\ListReservasi;
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
    Route::get('/reservasi', ListReservasi::class)->name('reservasi.index');
    Route::get('/reservasi/{id}', Reservasi::class)->name('reservasi.show');
    Route::get('/reservasi/{bookingId}/checklist', Checklist::class)->name('checklist');
});