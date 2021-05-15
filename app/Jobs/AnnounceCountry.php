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

class AnnounceCountry implements ShouldQueue
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
Next to sing is {$this->country->flag} {$this->country->name} with "{$this->country->song_title}" by {$this->country->artist}.

Stand by for voting to open!
EOD;

        $twilio->sendSms(
            $this->voter->number,
            $message
        );
    }
}
