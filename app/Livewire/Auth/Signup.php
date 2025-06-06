<?php

namespace App\Livewire\Auth;

use App\Helpers\GlobalHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Signup extends Component
{
    public  $email, $phone, $tab = 'phone', $page = 'signup';
    public $one, $two, $three, $four, $five, $six;
    public $seconds,$otp;

    public function tick()
    {
        if ($this->seconds > 0) {
            $this->seconds--;
        }
    }

    public function register()
    {
        $this->validate([
            'email' => 'nullable|required_if:tab,email|email',
            'phone' => 'nullable|required_if:tab,phone|regex:/^[0-9]{10}$/',
        ], [
            'email.required_if' => 'The Email Address cannot be empty.',
            'email.email' => 'The Email Address format is not valid.',
            'email.unique' => 'The Email Address already in use.',
            'phone.required_if' => 'The phone cannot be empty.',
            'phone.regex' => 'The phone format is not valid.',
            'phone.unique' => 'The phone already in use.',
        ]);

        if ($this->tab == 'email') {
            $this->otp = GlobalHelper::generateOtp();
            $user = User::firstOrNew([
                'email' => $this->email
            ]);
            $user->email = $this->email;
            $user->email_otp = $this->otp;
            $user->save();
        } else {
            $this->otp = GlobalHelper::generateOtp();
            $user = User::firstOrNew([
                'phone' => $this->phone
            ]);
            $user->phone = $this->phone;
            $user->phone_otp = $this->otp;
            $user->save();
            // GlobalHelper::sendOtp($user->phone, $this->otp);
        }
        $this->page = 'otp';
        $this->seconds = 120;
    }

    public function resendOtp(){
        $this->otp = GlobalHelper::generateOtp();
        $user = User::where([
            'phone' => $this->phone
        ])->first();
        if ($user) {
            $user->phone = $this->phone;
            $user->phone_otp = $this->otp;
            $user->save();
            // GlobalHelper::sendOtp($user->phone, $this->otp);
            $this->seconds = 120;
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'OTP send successfully'
            ]);
        }
    }

    public function verifyOtp()
    {
        $this->validate([
            'one' => 'required',
            'two' => 'required',
            'three' => 'required',
            'four' => 'required',
            'five' => 'required',
            'six' => 'required',
        ], [
            'one' => 'OTP is required',
            'two' => 'OTP is required',
            'three' => 'OTP is required',
            'four' => 'OTP is required',
            'five' => 'OTP is required',
            'six' => 'OTP is required',
        ]);

        $this->otp = $this->one.$this->two.$this->three.$this->four.$this->five.$this->six;
        $success = false;
        if ($this->tab == 'email') {
            $user = User::where([
                'email' => $this->email,
                'email_otp' => $this->otp
            ])->first();
            if($user){
                $user->update([
                    'email_verified_at' => Carbon::now(),
                    'email_otp' => NULL
                ]);
                $success = true;
            }
        } else {
            $user = User::where([
                'phone' => $this->phone,
                'phone_otp' => $this->otp
            ])->first();
            if($user){
                $user->update([
                    'phone_verified_at' => Carbon::now(),
                    'phone_otp' => NULL
                ]);
                $success = true;
            }else{
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Inavlid OTP. Please retry again!'
                ]);
            }
        }

        if($success){
            Auth::login($user);
            if($user->role == 'superadmin' || $user->role == 'admin'){
                return redirect()->route('admin.dashboard');
            }else if ($user->onboard_completed) {
                if ($user->role == 'individual') {
                    return redirect()->route('user.profile');
                } else if ($user->role == 'business') {
                    if($user->offering == 'product'){
                        return redirect()->route('business.profile');
                    }else{
                        return redirect()->route('service.profile');
                    }
                }
            } else {
                return redirect()->route('onboarding');
            }
        }
    }

    public function tabChange($value)
    {
        $this->tab = $value;
    }

    public function pageChange($value)
    {
        $this->page = $value;
    }

    public function render()
    {
        return view('livewire.auth.signup')->extends('layouts.auth-layout');
    }
}
