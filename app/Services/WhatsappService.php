<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WhatsappService
{
    public function send($phone, $message)
    {
        return Http::post('https://api.whatsapp-gateway.test/send', [
            'number' => $phone,
            'message' => $message,
        ]);
    }
}
