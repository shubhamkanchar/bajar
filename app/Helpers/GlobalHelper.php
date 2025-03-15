<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class GlobalHelper
{
    public static function sendOtp($mobile, $otp)
    {
        $apiKey = env('FAST2SMS_API_KEY');
        $senderId = env('FAST2SMS_SENDER_ID');
        $route = env('FAST2SMS_ROUTE');

        $message = "Your OTP is: $otp. Do not share it with anyone.";

        $response = Http::withHeaders([
            'authorization' => $apiKey,
            'accept' => 'application/json'
        ])->post('https://www.fast2sms.com/dev/bulkV2', [
            'message' => $message,
            'language' => 'english',
            'route' => $route,
            'numbers' => $mobile,
        ]);

        return $response->json();
    }
}
