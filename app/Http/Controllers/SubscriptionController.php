<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Subscription;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Exception;

class SubscriptionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'plan_id' => 'required',
        ]);

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            
            // Assuming plan details are fetched or passed. 
            // In Livewire it was fetched. We can fetch it here or just create subscription.
            // Let's create subscription.
            
            $subscription = $api->subscription->create([
                'plan_id' => $request->plan_id,
                'customer_notify' => 1,
                'total_count' => 12, 
            ]);

            // Need plan name. Fetch plan to get name? Or pass it.
            // Let's fetch plan to be safe and accurate.
            $plan = $api->plan->fetch($request->plan_id);
            $planName = $plan->item->name;

            Subscription::create([
                'user_id' => auth()->id(),
                'razorpay_subscription_id' => $subscription->id,
                'plan_id' => $request->plan_id,
                'plan_name' => $planName,
                'status' => 'created',
            ]);

            return response()->json([
                'success' => true,
                'subscription_id' => $subscription->id,
                'key' => config('services.razorpay.key'),
                'app_name' => env('APP_NAME'),
            ]);

        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function verify(Request $request)
    {
        $request->validate([
            'razorpay_subscription_id' => 'required',
            'razorpay_payment_id' => 'required',
        ]);

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $subscription = $api->subscription->fetch($request->razorpay_subscription_id);

            if ($subscription->start_at) {
                Subscription::where('razorpay_subscription_id', $request->razorpay_subscription_id)
                    ->update([
                        'status' => 'paid',
                        'payment_id' => $request->razorpay_payment_id,
                        'start_at' => $subscription->current_start ? Carbon::createFromTimestamp($subscription->current_start) : NULL,
                        'end_at' => $subscription->current_end ? Carbon::createFromTimestamp($subscription->current_end) : NULL,
                    ]);
            }

            return response()->json(['success' => true]);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
