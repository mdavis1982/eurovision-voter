<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Twilio\Security\RequestValidator;

class FromTwilio
{
    public function handle(Request $request, Closure $next): mixed
    {
        $requestValidator = new RequestValidator(env('TWILIO_TOKEN'));
        $requestData = $request->toArray();

        // If this is a JSON request, switch to the body content.
        if (array_key_exists('bodySHA256', $requestData)) {
            $requestData = $request->getContent();
        }

        $isValid = $requestValidator->validate(
            $request->header('X-Twilio-Signature'),
            $request->fullUrl(),
            $requestData
        );

        if ($isValid) {
            return $next($request);
        }

        return new Response('Requests to this URL must come from Twilio. :-(', 403);
    }
}
