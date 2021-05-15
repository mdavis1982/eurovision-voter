<?php

namespace App\Jobs;

use App\Models\Voter;
use App\Client\Twilio;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendInvitation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Voter $voter
    ) {
    }

    public function handle(Twilio $twilio): void
    {
        $message = <<<EOD
Hi, {$this->voter->name}!

You've been invited to vote on the Eurovision Song Contest final.

In order to play along, please reply with "OK" to this message.

It's going to be fun! 🎶
EOD;

        $twilio->sendSms(
            $this->voter->number,
            $message
        );
    }
}
