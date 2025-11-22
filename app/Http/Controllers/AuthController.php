<?php

namespace App\Http\Controllers;

use App\Helpers\GlobalHelper;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        $page = 'signin';
        return view('auth.login',compact('page'));
    }

    public function signup()
    {
        $page = 'signup';
        return view('auth.signup',compact('page'));
    }

    public function sendOtp(Request $request){
        $request->validate([
            'phone' => 'nullable|required_if:tab,phone|regex:/^[0-9]{10}$/',
        ], [
            'phone.required_if' => 'The phone cannot be empty.',
            'phone.regex' => 'The phone format is not valid.',
            'phone.unique' => 'The phone already in use.',
        ]);

        
        $otp = GlobalHelper::generateOtp();
        $user = User::where('phone', $request->phone)->first();
        
        if ($user) {
            $user->phone_otp = $otp;
            $user->save();
            GlobalHelper::sendOtp($user->phone, $otp);
        }
        
        
        if ($user) {
           return response()->json([
                'success' => true
           ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not registered! Please signup'
            ]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'phone' => 'nullable|required_if:tab,phone|regex:/^[0-9]{10}$/',
        ], [
            'phone.required_if' => 'The phone cannot be empty.',
            'phone.regex' => 'The phone format is not valid.',
            'phone.unique' => 'The phone already in use.',
        ]);

        
        $otp = GlobalHelper::generateOtp();
        $user = User::firstOrNew(['phone' => $request->phone]);
        $user->phone = $request->phone;
        $user->phone_otp = $otp;
        $user->save();
            
        GlobalHelper::sendOtp($user->phone, $otp);

        if ($user) {
           return response()->json([
                'success' => true
           ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not registered! Please signup'
            ]);
        }
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
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

        $otp = $request->one . $request->two . $request->three . $request->four . $request->five . $request->six;
        $user = null;

        
        $user = User::where([
            'phone' => $request->phone,
        ])->first();
        
        if ($user) {
            if($user->phone_otp == $otp){
                $user->update([
                    'phone_verified_at' => Carbon::now(),
                    'phone_otp' => NULL
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid OTP. Please retry again!'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'User not registered'
            ]);
        }
        
        Auth::login($user, true);
        return response()->json([
            'success' => true,
            'route' => route($this->getRedirectRoute($user))
        ]);
    }


    public function getRedirectRoute($user): string
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
}


