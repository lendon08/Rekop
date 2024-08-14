<?php

use App\Livewire\Pages\Auth\Login;
use App\Livewire\Pages\Auth\Register;

use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', Login::class);
    Route::get('login', Login::class)->name('login');
    Route::get('register', Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [Login::class, 'destroy'])->name('logout');
});
