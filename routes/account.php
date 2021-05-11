<?php

use Illuminate\Support\Facades\Route;

Route::prefix('account')
    ->name('account.')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    })
;
