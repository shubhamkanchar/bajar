<?php

namespace App\Livewire\User;

use App\Helpers\GlobalHelper;
use App\Mail\OtpMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{
    public $email, $model;
    public $phone, $state, $city, $sliderStatus, $emailVerifiedAt, $phoneVerifiedAt;
    public $name, $cityOptions = [], $stateOptions = [];
    public $one, $two, $three, $four, $five, $six;

    protected function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:15',
                Rule::unique('users', 'phone')->ignore(auth()->id()),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore(auth()->id()),
            ],
            'state' => 'required|string',
            'city' => 'required|string',
        ];
    }

    // Define custom messages for validation errors
    protected $messages = [
        'name.required_if' => 'Please enter your name.',
        'phone.required' => 'Please enter a valid phone number.',
        'phone.unique' => 'Phone is already in use',
        'email.email' => 'Please enter a valid email address.',
        'state.required' => 'Please select a state.',
        'city.required' => 'Please select a city.',
    ];

    public function setState()
    {
        foreach (config('state') as $key => $state) {
            array_push($this->stateOptions, $key);
        }
    }

    public function setCity()
    {
        if ($this->state) {
            $this->cityOptions = config('state')[$this->state];
        } else {
            $this->cityOptions = [];
        }
    }

    public function openVerifySlider($model)
    {
        $this->sliderStatus = 'open';
        $this->model = $model;
        if ($model == 'email') {
            $otp = rand(000000, 999999);
            $user = Auth::user();
            $user->email_otp = $otp;
            $user->save();

            Mail::to($user->email)->send(new OtpMail($otp, $user));
        }

        if ($model == 'phone') {
            // $otp = rand(000000, 999999);
            // $user = Auth::user();
            // $user->phone_otp = $otp;
            // $user->save();

            // $response = GlobalHelper::sendOtp($this->phone, $otp);
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
        $user = Auth::user();
        if ($this->model == 'email') {
            if ($user->email_otp == $otp) {
                $user->update([
                    'email_verified_at' => Carbon::now(),
                    'email_otp' => NULL
                ]);
            }
        } else if ($this->model == 'phone') {
            if ($user->phone_otp == $otp) {
                $user->update([
                    'phone_verified_at' => Carbon::now(),
                    'phone_otp' => NULL
                ]);
            }
        }
        $this->sliderStatus = '';
    }

    public function closeVerifySlider()
    {
        $this->sliderStatus = '';
    }

    public function render()
    {
        if (Auth::user()->email) {
            $this->email = Auth::user()->email;
        }
        if (Auth::user()->phone) {
            $this->phone = Auth::user()->phone;
        }
        if (Auth::user()->name) {
            $this->name = Auth::user()->name;
        }
        if (Auth::user()->address) {
            $this->city = Auth::user()->address->city;
        }
        if (Auth::user()->address) {
            $this->state = Auth::user()->address->state;
        }
        $this->emailVerifiedAt = Auth::user()->email_verified_at;
        $this->phoneVerifiedAt = Auth::user()->phone_verified_at;
        $this->setState();
        $this->setCity();
        return view('livewire.user.edit')->extends('layouts.profile-layout');
    }
}
