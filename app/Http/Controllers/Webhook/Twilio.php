<?php

namespace App\Http\Controllers\Webhook;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client\Twilio as TwilioClient;

class Twilio extends Controller
{
    public function __invoke(Request $request, TwilioClient $twilio)
    {
        $from = $request->From;
        $message = $request->Body;

        $response = <<<EOD
Thanks for messaging me! You said:

{$message}

Speak soon! 😀
EOD;

        $twilio->sendSms($from, $response);
    }
}
