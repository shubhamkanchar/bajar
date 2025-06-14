<div>
    @if($planName)
        <div class="row mt-2">
            <div class="col-md-12">
                <small>You don't have active subscription. Please subscribe to activate account</small>
            </div>
            <div class="col-md-3">
                <div class="border border-2 border-primary p-3 rounded-3 bg-primary bg-opacity-10">
                    <span class="d-block text-primary fw-bold">{{$planName}}</span>
                    <span>{{$amount/100}} / {{$interval}}</span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <button type="button" class="btn btn-dark mt-3 w-100" wire:click="createSubscription">
                    Subscribe Now
                </button>
            </div>
        </div>
        @if($user->latestSubscription)
            <div class="row">
                <div class="col-md-12 mt-3">
                    <small>If you already purchased subscription. then use refresh button to update status</small>
                </div>
                <div class="col-md-3">
                    <button type="button" class="btn btn-dark w-100" id="refreshSub" onclick="window.location.reload()">
                        Refresh
                    </button>
                </div>
            <div>
        @endif
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script>
            window.addEventListener('subscriptionReady', function(event) {
                const subscriptionId = event.detail[0];
                const options = {
                    key: '{{ config('services.razorpay.key') }}',
                    subscription_id: subscriptionId,
                    name: "{{ env('APP_NAME') }}",
                    description: "Subscription Payment",
                    handler: function (response) {
                        console.log(response)
                        Livewire.dispatch('paymentSuccess', {
                            'razorpaySubscriptionId': subscriptionId,
                            'paymentId':response.razorpay_payment_id
                        });
                    },
                    theme: {
                        color: "#3399cc"
                    }
                };

                const rzp = new Razorpay(options);
                rzp.open();
            });
        </script>
    @endif
</div>
