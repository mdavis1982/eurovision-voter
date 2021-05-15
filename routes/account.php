<?php

use Illuminate\Support\Facades\Route;

Route::prefix('account')->name('account.')->middleware(['auth'])->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('voters', App\Http\Controllers\VoterController::class);
    Route::resource('countries', App\Http\Controllers\CountryController::class);

    Route::post('send-invitations', [App\Http\Controllers\SendInvitationsController::class, '__invoke'])
        ->name('send-invitations')
    ;

    Route::post('countries/{country}/announce', [App\Http\Controllers\AnnounceCountryController::class, '__invoke'])
        ->name('countries.announce')
    ;

    Route::post('countries/{country}/open-voting', [App\Http\Controllers\OpenVotingController::class, '__invoke'])
        ->name('countries.open-voting')
    ;

    Route::post('countries/{country}/close-voting', [App\Http\Controllers\CloseVotingController::class, '__invoke'])
        ->name('countries.close-voting')
    ;
});
