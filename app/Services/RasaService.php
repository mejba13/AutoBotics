<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RasaService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = env('RASA_SERVER_URL'); // Get the Rasa server URL from .env
    }

    /**
     * Send a message to the Rasa server and get the response.
     *
     * @param string $sender
     * @param string $message
     * @return array
     * @throws \Exception
     */
    public function sendMessage(string $sender, string $message): array
    {
        $response = Http::post("{$this->baseUrl}/webhooks/rest/webhook", [
            'sender' => $sender,
            'message' => $message,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        throw new \Exception('Failed to connect to the Rasa server.');
    }
}
