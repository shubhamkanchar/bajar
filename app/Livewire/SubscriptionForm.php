<?php

namespace App\Livewire;

use Livewire\Component;
use Razorpay\Api\Api;
use App\Models\Subscription;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class SubscriptionForm extends Component
{
    public $planId = 'plan_Qh6fmlB7qj7uIT'; // Replace with your Razorpay plan_id
    public $subscriptionId,$planName,$amount,$interval;
    public $user;
    protected $listeners = ['paymentSuccess'];

    public function mount($user){
        $this->user = $user;
        $this->getRazorpayPlanById();

        $razorpaySubscriptionId = $this->user->latestSubscription?->razorpay_subscription_id;
        if($razorpaySubscriptionId){
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $subscription = $api->subscription->fetch($razorpaySubscriptionId);
            if($subscription->start_at){
                Subscription::where('razorpay_subscription_id', $razorpaySubscriptionId)
                ->update([
                    'status' => $subscription->status,
                    'start_at' => Carbon::createFromTimestamp($subscription->current_start),
                    'end_at' => Carbon::createFromTimestamp($subscription->current_end),
                ]);
            }
        }
    }
    public function createSubscription()
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $subscription = $api->subscription->create([
            'plan_id' => $this->planId,
            'customer_notify' => 1,
            'total_count' => 12, // e.g. for monthly, for 1 year
        ]);

        $this->subscriptionId = $subscription->id;
        Subscription::create([
            'user_id' => auth()->id(),
            'razorpay_subscription_id' => $subscription->id,
            'plan_id' => $this->planId,
            'plan_name' => $this->planName,
            'status' => 'created',
        ]);

        $this->dispatch('subscriptionReady', $this->subscriptionId);
    }

    public function getRazorpayPlanById()
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        try {
            $plan = $api->plan->fetch($this->planId);
            $this->planName = $plan->item->name;
            $this->amount = $plan->item->amount; // in paise
            $this->interval = $plan->period;
        } catch (\Exception $e) {
            logger()->error("Razorpay Plan fetch failed: " . $e->getMessage());
            return null;
        }
    }

    #[On('paymentSuccess')]
    public function paymentSuccess(string $razorpaySubscriptionId,$paymentId)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $subscription = $api->subscription->fetch($razorpaySubscriptionId);
        if($subscription->start_at){
            Subscription::where('razorpay_subscription_id', $razorpaySubscriptionId)
            ->update([
                'status' => 'paid',
                'payment_id' => $paymentId,
                'start_at' => $subscription->current_start ? Carbon::createFromTimestamp($subscription->current_start) : NULL,
                'end_at' => $subscription->current_end ? Carbon::createFromTimestamp($subscription->current_end) : NULL,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.subscription-form');
    }
}

