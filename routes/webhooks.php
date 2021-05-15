<?php

use Illuminate\Support\Facades\Route;

Route::prefix('webhook')->name('webhook.')->group(function () {
    Route::post('twilio', [App\Http\Controllers\Webhook\Twilio::class, '__invoke'])
        ->middleware(['from-twilio'])
        ->name('twilio')
    ;
});
