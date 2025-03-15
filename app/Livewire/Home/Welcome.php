<?php

namespace App\Livewire\Home;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Welcome extends Component
{

    public function dashboardRedirect()
    {
        $user = Auth::user();
        if ($user->onboard_completed) {
            if ($user->type == 'individual') {
                return route('user.profile');
            } else if ($user->type == 'business') {
                return route('business.profile');
            } else if ($user->type == 'service') {
                return route('service.profile');
            }
        } else {
            return route('onboarding');
        }
    }

    public function render()
    {
        return view('livewire.home.welcome')->extends('layouts.home');;
    }
}
