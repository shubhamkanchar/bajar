<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Livewire\Component;

class Login extends Component
{
    public  $email, $phone, $tab = 'email', $page = 'signin';
    public $one, $two, $three, $four, $five, $six;

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
            $user = User::firstOrNew([
                'email' => $this->email
            ]);
            $user->email = $this->email;
            $user->email_otp = rand(000000, 999999);
            $user->save();
        } else {
            $user = User::firstOrNew([
                'phone' => $this->phone
            ]);
            $user->phone = $this->phone;
            $user->phone_otp = rand(000000, 999999);
            $user->save();
        }
        $this->page = 'otp';
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
                'phone' => $this->email,
                'phone_otp' => $otp
            ])->first();
            if ($user) {
                $user->update([
                    'phone_verified_at' => Carbon::now(),
                    'phone_otp' => NULL
                ]);
                $success = true;
            }
        }

        if ($success) {
            Auth::login($user);
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
        if ($request->state) {
            try {
                $googleUser = Socialite::driver('google')->stateless()->user();
                $user = User::where('email', $googleUser->getEmail())->first();

                if (!$user) {
                    $user = User::create([
                        'name' => $googleUser->getName(),
                        'email' => $googleUser->getEmail(),
                        'email_otp' => rand(000000, 999999)
                    ]);
                }
                $this->email = $googleUser->getEmail();
                $this->page = 'otp';
            } catch (Exception $e) {
                
            }
        }

        return view('livewire.auth.login')->extends('layouts.auth-layout');
    }
}
