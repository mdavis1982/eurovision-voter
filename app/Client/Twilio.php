<?php

namespace App\Client;

use Twilio\Rest\Client;
use Twilio\Rest\Api\V2010\Account\MessageInstance;

class Twilio
{
    /** @var Client */
    private $client;

    public function __construct(string $sid, string $token)
    {
        $this->client = new Client($sid, $token);
    }

    public function sendSms(string $number, string $text, ?string $from = null): MessageInstance
    {
        return $this->client->messages->create(
            $number,
            [
                'body' => $text,
                'from' => $from ?? config('services.twilio.messaging-service'),
            ]
        );
    }
}
