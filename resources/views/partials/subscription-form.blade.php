@if($planName)
    @if(optional($user->latestSubscription)->status != 'paid')
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
                <button type="button" class="btn btn-dark mt-3 w-100" id="btn-subscribe">
                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true" id="sub-loading"></span>
                    Subscribe Now
                </button>
            </div>
        </div>
    @endif

    @if(optional($user->latestSubscription)->status == 'paid')
        <div class="row">
            <div class="col-md-12 mt-3">
                <small>If you already purchased subscription. then use refresh button to update status</small>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-dark w-100" id="refreshSub" onclick="window.location.reload()">
                    Refresh
                </button>
            </div>
        </div>
    @endif

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function() {
            $('#btn-subscribe').on('click', function(e) {
                e.preventDefault();
                var $btn = $(this);
                $btn.prop('disabled', true);
                $('#sub-loading').removeClass('d-none');

                $.ajax({
                    url: "{{ route('subscription.create') }}",
                    method: 'POST',
                    data: {
                        plan_id: "{{ $planId }}",
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            var options = {
                                key: response.key,
                                subscription_id: response.subscription_id,
                                name: response.app_name,
                                description: "Subscription Payment",
                                handler: function (paymentResponse) {
                                    verifySubscription(response.subscription_id, paymentResponse.razorpay_payment_id);
                                },
                                theme: {
                                    color: "#3399cc"
                                }
                            };
                            var rzp = new Razorpay(options);
                            rzp.open();
                        } else {
                            alert('Error creating subscription: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
                    },
                    complete: function() {
                        $btn.prop('disabled', false);
                        $('#sub-loading').addClass('d-none');
                    }
                });
            });

            function verifySubscription(subId, paymentId) {
                $.ajax({
                    url: "{{ route('subscription.verify') }}",
                    method: 'POST',
                    data: {
                        razorpay_subscription_id: subId,
                        razorpay_payment_id: paymentId,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Subscription processed successfully!');
                            window.location.reload();
                        } else {
                            alert('Verification failed: ' + response.message);
                        }
                    },
                    error: function(xhr) {
                        alert('Verification Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
                    }
                });
            }
        });
    </script>
@endif
