<?php

namespace App\Jobs;

use App\Models\Voter;
use App\Client\Twilio;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ConfirmVoter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Voter $voter
    ) {
    }

    public function handle(Twilio $twilio): void
    {
        $this->voter->update([
            'confirmed_at' => now(),
        ]);

        $message = <<<EOD
Thanks for confirming, {$this->voter->name}!

Look out for texts during the Eurovision final, and get ready to cast your votes!
EOD;

        $twilio->sendSms(
            $this->voter->number,
            $message
        );
    }
}
