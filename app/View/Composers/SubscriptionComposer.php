<?php

namespace App\View\Composers;

use Illuminate\View\View;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;

class SubscriptionComposer
{
    public function compose(View $view)
    {
        $planId = env('PLAN_ID'); 
        $planName = '';
        $amount = 0;
        $interval = '';

        if ($planId) {
            try {
                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                // Use Cache if possible in future, for now Request-based or direct
                // Since this is external API call, we SHOULD cache it. 
                // But following existing pattern first.
                // existing pattern: fetch every time.
                
                $plan = $api->plan->fetch($planId);
                $planName = $plan->item->name;
                $amount = $plan->item->amount;
                $interval = $plan->period;
                
            } catch (\Exception $e) {
                Log::error("Razorpay Plan fetch failed: " . $e->getMessage());
            }
        }

        $view->with('planId', $planId)
             ->with('planName', $planName)
             ->with('amount', $amount)
             ->with('interval', $interval);
    }
}
