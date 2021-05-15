<?php

use Illuminate\Support\Facades\Route;

Route::prefix('account')->name('account.')->middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('voters', App\Http\Controllers\VoterController::class);

    Route::post('send-invitations', [App\Http\Controllers\SendInvitationsController::class, '__invoke'])
        ->name('send-invitations')
    ;
});
