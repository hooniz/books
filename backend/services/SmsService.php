<?php

namespace backend\services;

use yii\httpclient\Client;
use yii\httpclient\Exception;

class SmsService
{
    private string $apiKey;

    public function __construct(string $apiKey = 'EMULATOR')
    {
        $this->apiKey = $apiKey;
    }

    /**
     * Sends an SMS message to the specified phone number.
     *
     * @throws Exception
     */
    public function sendSms(string $phone, string $message): bool
    {
        $client = new Client(['baseUrl' => 'https://smspilot.ru/api.php']);

        $response = $client->get('', [
            'send' => $message,
            'to' => $phone,
            'apikey' => $this->apiKey,
            'format' => 'json',
        ])->send();

        return $response->isOk;
    }
}