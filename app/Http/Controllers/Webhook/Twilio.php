<?php

namespace App\Http\Controllers\Webhook;

use App\Models\Voter;
use App\Jobs\ConfirmVoter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client\Twilio as TwilioClient;

class Twilio extends Controller
{
    public function __invoke(Request $request, TwilioClient $twilio)
    {
        if (! $voter = Voter::where('number', '=', $request->From)->first()) {
            $twilio->sendSms($request->From, 'Sorry. You must be invited to vote. :-(');
        }

        match (Str::lower($request->Body)) {
            'ok' => ConfirmVoter::dispatch($voter)
        };
    }
}
