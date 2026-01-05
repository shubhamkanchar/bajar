@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Test Subscription Form</h1>
    @php
        // Mock data similar to what SubscriptionForm expected
        $planName = 'Test Plan';
        $amount = 10000; // 100 INR
        $interval = 'monthly';
        $user = auth()->user();
    @endphp
    
    @include('partials.subscription-form', ['user' => $user])
</div>
@endsection
