<?php

namespace App\Jobs;

use App\Models\Vote;
use App\Models\Voter;
use App\Client\Twilio;
use App\Models\Country;
use Illuminate\Foundation\Bus\Dispatchable;

class CastVote
{
    use Dispatchable;

    public function __construct(
        public Country $country,
        public Voter $voter,
        public int $value
    ) {
    }

    public function handle(Twilio $twilio): void
    {
        Vote::create([
            'voter_id' => $this->voter->id,
            'country_id' => $this->country->id,
            'value' => $this->value,
        ]);

        $twilio->sendSms(
            $this->voter->number,
            "Thanks for your vote for {$this->country->name}!"
        );
    }
}
