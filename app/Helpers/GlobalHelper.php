<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GlobalHelper
{
    public static function sendOtp($mobile, $otp)
    {
        try{
            $apiKey = env('FAST2SMS_API_KEY');
            $senderId = env('FAST2SMS_SENDER_ID'); 
            $route = env('FAST2SMS_ROUTE', 'dlt'); 
            $templateId = env('FAST2SMS_TEMPLATE_ID'); // Approved DLT Template ID
            $message = env('FAST2SMS_MESSAGE_ID');

            $response = Http::withHeaders([
                'authorization' => $apiKey,
                'accept' => 'application/json'
            ])->post('https://www.fast2sms.com/dev/bulkV2', [
                'sender_id'   => $senderId,
                'message'     => $message,
                'route'       => $route,
                'numbers'     => $mobile,
                'variables_values' => $otp,
                'template_id' => $templateId // 👈 Mandatory for DLT
            ]);
            return $response->json();
        }catch(Exception $e){
            Log::info($e->getMessage());
        }
    }

    public static function generateOtp()
    {
        return sprintf("%06d", rand(0, 999999));
    }
}
