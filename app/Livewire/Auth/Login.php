<?php

namespace App\Livewire\Auth;

use App\Helpers\GlobalHelper;
use App\Mail\OtpMail;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Component;
use Symfony\Component\Finder\Glob;

class Login extends Component
{
    public  $email, $phone = '', $tab = 'phone', $page = 'signin';
    public $one, $two, $three, $four, $five, $six;
    public $remember = true;
    public $seconds;

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
            $otp = GlobalHelper::generateOtp();
            $user = User::where([
                'email' => $this->email
            ])->first();
            if ($user) {
                $user->email = $this->email;
                $user->email_otp = $otp;
                $user->save();
                Mail::to($user->email)->send(new OtpMail($otp, $user));
            }
        } else {
            $otp = GlobalHelper::generateOtp();
            $user = User::where([
                'phone' => $this->phone
            ])->first();
            if ($user) {
                $user->phone = $this->phone;
                $user->phone_otp = $otp;
                $user->save();
                GlobalHelper::sendOtp($user->phone, $otp);
            }
        }
        if ($user) {
            $this->page = 'otp';
            $this->seconds = 60;
        }else{
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'User not found. Please signup'
            ]);
        }
    }

    public function resendOtp(){
        $otp = GlobalHelper::generateOtp();
        $user = User::where([
            'phone' => $this->phone
        ])->first();
        if ($user) {
            $user->phone = $this->phone;
            $user->phone_otp = $otp;
            $user->save();
            GlobalHelper::sendOtp($user->phone, $otp);
            $this->seconds = 60;
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

        $otp = $this->one . $this->two . $this->three . $this->four . $this->five . $this->six;
        $success = false;
        if ($this->tab == 'email') {
            $user = User::where([
                'email' => $this->email,
                'email_otp' => $otp
            ])->first();
            if ($user) {
                $user->update([
                    'email_verified_at' => Carbon::now(),
                    'email_otp' => NULL
                ]);
                $success = true;
            }
        } else {
            $user = User::where([
                'phone' => $this->phone,
                'phone_otp' => $otp
            ])->first();
            if ($user) {
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

        if ($success) {
            $this->loginSucess($user);
        }
    }

    public function loginSucess($user)
    {
        Auth::login($user,$this->remember);
        // session()->regenerate();
        if($user->role == 'superadmin' || $user->role == 'admin'){
            return redirect()->route('admin.dashboard');
        }else if ($user->onboard_completed) {
            if ($user->type == 'individual') {
                return redirect()->route('user.profile');
            } else if ($user->type == 'business') {
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

    public function tabChange($value)
    {
        $this->tab = $value;
    }

    public function pageChange($value)
    {
        $this->page = $value;
    }

    public function render(Request $request)
    {
        return view('livewire.auth.login')->extends('layouts.auth-layout');
    }
}
