<?php

namespace App\Providers;

use App\Client\Twilio;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Twilio::class, function ($app) {
            return new Twilio(
                config('services.twilio.sid'),
                config('services.twilio.token')
            );
        });
    }

    public function boot(): void
    {
    }
}
