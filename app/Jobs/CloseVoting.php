<?php

namespace App\Jobs;

use App\Models\Voter;
use App\Client\Twilio;
use App\Models\Country;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class CloseVoting implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Country $country,
        public Voter $voter
    ) {
    }

    public function handle(Twilio $twilio): void
    {
        $message = <<<EOD
Voting for {$this->country->name} is now closed!
EOD;

        $twilio->sendSms(
            $this->voter->number,
            $message
        );
    }
}
