<?php

namespace App\Livewire\Auth;

use App\Helpers\GlobalHelper;
use App\Mail\OtpMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Signup extends Component
{
    public $email, $phone, $tab = 'phone', $page = 'signup';
    public $one, $two, $three, $four, $five, $six;
    public $seconds, $otp;
    public $remember = true;

    public function mount()
    {
        // Check if already authenticated
        if (Auth::check()) {
            $this->loginSuccess(Auth::user());
        }
    }

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
            $user = User::firstOrNew(['email' => $this->email]);
            $user->email = $this->email;
            $user->email_otp = $this->otp;
            $user->save();
            
            // Send OTP via email
            Mail::to($user->email)->send(new OtpMail($this->otp, $user));
        } else {
            $this->otp = GlobalHelper::generateOtp();
            $user = User::firstOrNew(['phone' => $this->phone]);
            $user->phone = $this->phone;
            $user->phone_otp = $this->otp;
            $user->save();
            
            // Send OTP via SMS
            GlobalHelper::sendOtp($user->phone, $this->otp);
        }
        
        $this->page = 'otp';
        $this->seconds = 120;
    }

    public function resendOtp()
    {
        $this->otp = GlobalHelper::generateOtp();
        $user = User::where('phone', $this->phone)->first();
        
        if ($user) {
            $user->phone_otp = $this->otp;
            $user->save();
            GlobalHelper::sendOtp($user->phone, $this->otp);
            $this->seconds = 120;
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'OTP sent successfully'
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
            'one.required' => 'OTP is required',
            'two.required' => 'OTP is required',
            'three.required' => 'OTP is required',
            'four.required' => 'OTP is required',
            'five.required' => 'OTP is required',
            'six.required' => 'OTP is required',
        ]);

        $this->otp = $this->one . $this->two . $this->three . $this->four . $this->five . $this->six;
        $success = false;
        $user = null;

        if ($this->tab == 'email') {
            $user = User::where([
                'email' => $this->email,
                'email_otp' => $this->otp
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
                'phone_otp' => $this->otp
            ])->first();
            
            if ($user) {
                $user->update([
                    'phone_verified_at' => Carbon::now(),
                    'phone_otp' => NULL
                ]);
                $success = true;
            } else {
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Invalid OTP. Please retry again!'
                ]);
            }
        }

        if ($success && $user) {
            $this->loginSuccess($user);
        }
    }

    /**
     * CRITICAL FIX: Properly handle login with session regeneration
     */
    public function loginSuccess($user)
    {
        // Login the user
        Auth::login($user, $this->remember);
        
        // CRITICAL: Regenerate session to prevent session fixation
        request()->session()->regenerate();
        
        // Determine redirect route
        $redirectRoute = $this->getRedirectRoute($user);
        
        return redirect()->route($redirectRoute);
    }

    /**
     * Get the appropriate redirect route based on user role
     */
    private function getRedirectRoute($user): string
    {
        // Admin users
        if (in_array($user->role, ['superadmin', 'admin'])) {
            return 'admin.dashboard';
        }
        
        // Users who haven't completed onboarding
        if (!$user->onboard_completed) {
            return 'onboarding';
        }
        
        // Regular users based on role
        return match($user->role) {
            'individual' => 'user.profile',
            'business' => $user->offering === 'product' 
                ? 'business.profile' 
                : 'service.profile',
            default => 'onboarding'
        };
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
        return view('livewire.auth.signup');
    }
}