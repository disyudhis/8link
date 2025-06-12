<?php

use App\Livewire\AntrianAdmin;
use App\Livewire\Home;
use App\Livewire\Checklist;
use App\Livewire\PengerjaanAdmin;
use App\Livewire\Reservasi;
use App\Livewire\ListReservasi;
use App\Livewire\PaketPengerjaan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::middleware('admin')
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/', AntrianAdmin::class)->name('antrian');
            Route::get('/pengerjaan/{id}', PengerjaanAdmin::class)->name('pengerjaan');
            // Route::get('/reservasi/{id}', Reservasi::class)->name('reservasi.show');
        });

    Route::middleware('worker')
        ->prefix('worker')
        ->name('worker.')
        ->group(function () {
        });

    Route::middleware('user')
        ->prefix('user')
        ->name('user.')
        ->group(function () {
            Route::get('/', Home::class)->name('home');
            Route::get('/paket-pengerjaan', PaketPengerjaan::class)->name('paket-pengerjaan');
            Route::get('/reservasi', ListReservasi::class)->name('reservasi.index');
            Route::get('/reservasi/{id}', Reservasi::class)->name('reservasi.show');
            Route::get('/reservasi/{bookingId}/checklist', Checklist::class)->name('checklist');
        });
});