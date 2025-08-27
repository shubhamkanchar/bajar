<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Http;

class GlobalHelper
{
    public static function sendOtp($mobile, $otp)
    {
        $apiKey = env('FAST2SMS_API_KEY');
        $senderId = env('FAST2SMS_SENDER_ID'); // Your 6-char sender ID registered in DLT
        $route = env('FAST2SMS_ROUTE', 'dlt'); // Use "dlt" route
        $templateId = env('FAST2SMS_TEMPLATE_ID'); // Approved DLT Template ID

        // ⚡ Template message MUST match exactly with DLT-approved template
        $message = "Your OTP is: {$otp}. Do not share it with anyone.";

        $response = Http::withHeaders([
            'authorization' => $apiKey,
            'accept' => 'application/json'
        ])->post('https://www.fast2sms.com/dev/bulkV2', [
            'sender_id'   => $senderId,
            'message'     => $message,
            'route'       => $route,
            'language'    => 'english',
            'numbers'     => $mobile,
            'template_id' => $templateId // 👈 Mandatory for DLT
        ]);

        return $response->json();
    }

    public static function generateOtp()
    {
        return sprintf("%06d", rand(0, 999999));
    }
}
