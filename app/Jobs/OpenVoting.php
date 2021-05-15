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

class OpenVoting implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Country $country,
        public Voter $voter
    ) {
    }

    public function handle(Twilio $twilio): void
    {
        $max = config('eurovision.voting.max');

        $message = <<<EOD
Voting for {$this->country->name} is now open!
Reply with a number from 0 - {$max} to cast your vote.
EOD;

        $twilio->sendSms(
            $this->voter->number,
            $message
        );
    }
}
