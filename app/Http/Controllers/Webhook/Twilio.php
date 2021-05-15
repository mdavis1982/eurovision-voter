<?php

namespace App\Http\Controllers\Webhook;

use App\Models\Voter;
use App\Jobs\CastVote;
use App\Models\Country;
use App\Jobs\ConfirmVoter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client\Twilio as TwilioClient;

class Twilio extends Controller
{
    public function __invoke(Request $request, TwilioClient $twilio)
    {
        if (! $voter = Voter::with('votes')->where('number', '=', $request->From)->first()) {
            return $twilio->sendSms($request->From, 'Sorry. You must be invited to vote. :-(');
        }

        if ('ok' === Str::lower($request->Body)) {
            ConfirmVoter::dispatch($voter);

            return;
        }

        if (0 === Country::currentlyVoting()->count()) {
            return $twilio->sendSms($request->From, 'Sorry. Voting is currently closed. :-(');
        }

        if (! is_numeric($request->Body) || (int) $request->Body < 0 || (int) $request->Body > 10) {
            return $twilio->sendSms($request->From, 'You must vote with a value between 0 - 10. Try again.');
        }

        $country = Country::currentlyVoting()->first();
        if ($voter->votes->where('country_id', $country->id)->isNotEmpty()) {
            return $twilio->sendSms($request->From, "You've already voted for {$country->name}. This vote won't be counted!");
        }

        CastVote::dispatch($country, $voter, (int) $request->Body);
    }
}
