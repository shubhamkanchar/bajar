<?php

namespace App\Livewire\Business;

use App\Helpers\GlobalHelper;
use App\Mail\OtpMail;
use App\Models\Address;
use App\Models\BusinessCategory;
use App\Models\BusinessTime;
use App\Models\Category;
use App\Models\Subscription;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Razorpay\Api\Api;

class Edit extends Component
{
    use WithFileUploads;

    public $email, $model, $pin_code;
    public $phone, $state, $city, $sliderStatus, $emailVerifiedAt, $phoneVerifiedAt;
    public $name, $cityOptions = [], $stateOptions = [];
    public $one, $two, $three, $four, $five, $six;
    public $profileImage, $bgImage, $address, $map, $gst, $offering, $user,$otp,$seconds;
    public $categoryIds = [];
    public $days = [
        'Monday',
        'Tuesday',
        'Wednesday',
        'Thursday',
        'Friday',
        'Saturday',
        'Sunday'
    ];
    public $storeHours = [];

    public function mount(Request $request)
    {
        $this->user = User::where('uuid', $request->uuid)->first();
        if ($this->user->email) {
            $this->email = $this->user->email;
        }
        if ($this->user->phone) {
            $this->phone = $this->user->phone;
        }
        if ($this->user->name) {
            $this->name = $this->user->name;
        }
        if ($this->user->gst) {
            $this->gst = $this->user->gst;
        }
        if ($this->user->address) {
            $this->city = $this->user->address->city;
        }
        if ($this->user->address) {
            $this->state = $this->user->address->state;
        }
        if ($this->user->address) {
            $this->address = $this->user->address->address;
        }
        if ($this->user->address) {
            $this->map = $this->user->address->map_link;
        }
        if ($this->user->offering) {
            $this->offering = $this->user->offering;
        }
        $this->categoryIds = BusinessCategory::where('user_id', $this->user->id)->pluck('category_id')->toArray();
        $this->setState();
        $this->setCity();

        $existingHours = BusinessTime::where('user_id', $this->user->id)->get();
        foreach ($this->days as $day) {
            $this->storeHours[$day] = [
                'open' => optional($existingHours->where('day', $day)->first())->open_time ?? '',
                'close' => optional($existingHours->where('day', $day)->first())->close_time ?? ''
            ];
        }
        try{
            $razorpaySubscriptionId = $this->user->latestSubscription?->razorpay_subscription_id;
            if($razorpaySubscriptionId){
                $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
                $subscription = $api->subscription->fetch($razorpaySubscriptionId);
                if($subscription->start_at){
                    Subscription::where('razorpay_subscription_id', $razorpaySubscriptionId)
                    ->update([
                        'status' => $subscription->status,
                        'start_at' => Carbon::createFromTimestamp($subscription->current_start),
                        'end_at' => Carbon::createFromTimestamp($subscription->current_end),
                    ]);
                }
            }
        }catch(Exception $e){

        }

    }

    public function setOffering($offering)
    {
        $this->offering = $offering;
        $this->categoryIds = [];
    }

    protected function rules()
    {
        return [
            'name' => 'nullable|string|max:255',
            'phone' => [
                'string',
                'min:10',
                'max:15',
                Rule::unique('users', 'phone')->ignore($this->user->id),
            ],
            'email' => [
                'email',
                Rule::unique('users', 'email')->ignore($this->user->id),
            ],
            'state' => 'string',
            'city' => 'string',
            'bgImage' => 'nullable|image|max:2048',
            'profileImage' => 'nullable|image|max:2048',
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

    public function tick()
    {
        if ($this->seconds > 0) {
            $this->seconds--;
        }
    }

    public function openVerifySlider($model)
    {
        $this->sliderStatus = 'open';
        $this->model = $model;
        $this->seconds = 120;
        $this->otp = GlobalHelper::generateOtp();
        if ($model == 'email') {
            $this->user->email_otp = $this->otp;
            $this->user->save();
            Mail::to($this->user->email)->send(new OtpMail($this->otp, $this->user));
        }

        if ($model == 'phone') {
            $this->user->phone_otp = $this->otp;
            $this->user->save();
            GlobalHelper::sendOtp($this->phone, $this->otp);
        }
    }

    public function resendOtp(){
        $this->otp = GlobalHelper::generateOtp();
        if ($this->user) {
            $this->user->email_otp = $this->otp;
            $this->user->save();
            Mail::to($this->user->email)->send(new OtpMail($this->otp, $this->user));
            $this->seconds = 120;
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'OTP send successfully'
            ]);
        }
    }

    public function update()
    {
        $this->validate();

        if (!empty($this->bgImage)) {
            $imagePath = $this->bgImage->store('images', 'public');
        }

        if (!empty($this->profileImage)) {
            $profilePath = $this->profileImage->store('images', 'public');
        }


        $this->user->name = $this->name;
        if (isset($imagePath)) {
            $this->user->bg_image = $imagePath;
        }
        if (isset($profilePath)) {
            $this->user->profile_image = $profilePath;
        }
        if ($this->user->phone != $this->phone) {
            $this->user->phone = $this->phone;
            $this->user->phone_verified_at = NULL;
        }
        if ($this->user->email != $this->email) {
            $this->user->email = $this->email;
            $this->user->email_verified_at = NULL;
        }
        $this->user->gst = $this->gst;
        $this->user->save();

        $address = Address::firstOrNew(['user_id' => $this->user->id]);
        $address->address = $this->address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->pin_code = $this->pin_code;
        $address->map_link = $this->map;
        $address->save();

        BusinessCategory::where('user_id', $this->user->id)->delete();
        foreach ($this->categoryIds as $category) {
            BusinessCategory::updateOrCreate([
                'user_id' => $this->user->id,
                'category_id' => $category
            ], [
                'user_id' => $this->user->id,
                'category_id' => $category
            ]);
        }

        foreach ($this->storeHours as $day => $times) {
            BusinessTime::updateOrCreate(
                ['day' => $day,'user_id'=>$this->user->id],
                ['open_time' => $times['open'] ?? NULL, 'close_time' => $times['close'] ?? NULL]
            );
        }

        $this->dispatch('notify', [
            'type' => 'success',
            'message' => 'Profile Updated Successfully'
        ]);
    }

    public function setReviewer()
    {
        $this->user->is_reviewer = $this->user->is_reviewer ? 0 : 1;
        $this->user->save();
        $this->dispatch('notify', [
            'type' => 'success',
            'message' => $this->user->is_reviewer ? 'User set as reviewer successfully' : 'User unset as reviewer successfully'
        ]);
    }

    public function deleteUser()
    {
        if($this->user){
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'User deleted successfully',
            ]);
            if($this->offering == 'product'){
                $this->redirectRoute('admin.dashboard',['tab'=>'product-sellers']);
            }else{
                $this->redirectRoute('admin.dashboard',['tab'=>'service-providers']);
            }
        }else{
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
        
    }

    public function limitText($text, $limit = 20) {
        if (mb_strlen($text) > $limit) {
            return mb_substr($text, 0, $limit) . '.';
        }
        return $text;
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

        if ($this->model == 'email') {
            if ($this->user->email_otp == $otp) {
                $this->user->update([
                    'email_verified_at' => Carbon::now(),
                    'email_otp' => NULL
                ]);
                $this->sliderStatus = '';
            }else{
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Wrong OTP',
                ]);
            }
        } else if ($this->model == 'phone') {
            if ($this->user->phone_otp == $otp) {
                $this->user->update([
                    'phone_verified_at' => Carbon::now(),
                    'phone_otp' => NULL
                ]);
                $this->sliderStatus = '';
            }else{
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => 'Wrong OTP',
                ]);
            }
        }
        $this->one =$this->two= $this->three= $this->four= $this->five= $this->six ='';
    }

    public function addCategory($id)
    {
        if (count($this->categoryIds) < 3) {
            array_push($this->categoryIds, $id);
        } else {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Max category selected'
            ]);
        }
    }

    public function removeCategory($id)
    {
        $arr =  array_diff($this->categoryIds, [$id]);
        $this->categoryIds = $arr;
    }

    public function closeVerifySlider()
    {
        $this->sliderStatus = '';
    }

    public function render()
    {
        $productCategories = Category::where('type', 'product')->get();
        $serviceCategories = Category::where('type', 'service')->get();
        $this->emailVerifiedAt = $this->user->email_verified_at;
        $this->phoneVerifiedAt = $this->user->phone_verified_at;
        return view('livewire.business.edit', compact('productCategories', 'serviceCategories'))->extends('layouts.profile-layout');
    }
}
