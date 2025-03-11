<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Onboarding extends Component
{
    public $step = 1;
    public $userType;
    public $totalSteps;

    // Step 2 fields for Individual
    public $name;
    public $phone;
    public $address;
    public $state;
    public $city;
    public $email;
    public $pin_code;
    public $offering;

    public $categoryIds = [];
    // Step 2 fields for Business
    public $gst_number;
    public $google_map_link;

    // Define validation rules for step 2
    protected $rules = [
        'name' => 'nullable|string|max:255',
        'phone' => 'required|string|min:10|max:15',
        'email' => 'required|email',
        'state' => 'required|string',
        'city' => 'required|string',
        // 'gst_number' => 'nullable|numeric|digits:15',
        // 'business_address' => 'nullable|string|max:255',
        // 'google_map_link' => 'nullable|url',
    ];

    // Define custom messages for validation errors
    protected $messages = [
        'name.required_if' => 'Please enter your name.',
        'phone.required' => 'Please enter a valid phone number.',
        'email.email' => 'Please enter a valid email address.',
        'state.required' => 'Please select a state.',
        'city.required' => 'Please select a city.',
        // 'business_name.required_if' => 'Please enter your business name.',
        // 'gst_number.numeric' => 'Please enter a valid GST number.',
        // 'business_address.required_if' => 'Please enter your business address.',
        // 'google_map_link.url' => 'Please enter a valid Google Map link.',
    ];


    public function selectUserType($type)
    {
        $this->userType = $type;
        $this->totalSteps = ($type === 'business') ? 4 : 3; // Set steps based on selection
    }

    public function nextStep()
    {
        if ($this->step !== 1) {
            $this->validate();
        }
        if ($this->step < $this->totalSteps) {
            $this->step++;
        }

        if($this->userType == 'individual' && $this->step == 3){
            try{
                $user = Auth::user();
                $user->name = $this->name;
                $user->phone = $this->phone;
                $user->type = 'individual';
                $user->save();
                
                $address = Address::firstOrNew(['user_id'=>$user->id]);
                $address->city = $this->city;
                $address->state = $this->state;
                $address->save();
            }catch(Exception $e){
                
            }
        }

        if($this->userType == 'business' && $this->step == 4){
            try{
                $user = Auth::user();
                $user->name = $this->name;
                $user->phone = $this->phone;
                $user->type = 'business';
                $user->offering = $this->offering;
                $user->gst_number = $this->gst_number;
                $user->save();
                
                $address = Address::firstOrNew(['user_id'=>$user->id]);
                $address->address = $this->address;
                $address->city = $this->city;
                $address->state = $this->state;
                $address->pin_code = $this->pin_code;
                $address->map_link = $this->google_map_link;
                $address->save();
            }catch(Exception $e){
                
            }
        }
    }

    public function finalize(){
        $user = Auth::user();
        $user->onboard_completed = 1;
        $user->save();

        if($user->type == 'individual'){
            return redirect()->route('home');
        }else if($user->type == 'business'){
            return redirect()->route('business.profile');
        }
    }

    public function setOffering($offering){
        $this->offering = $offering;
        $this->categoryIds = [];
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function addCategory($id){
        array_push($this->categoryIds,$id);
    }

    public function removeCategory($id){
        array_diff($this->categoryIds,$id);
    }

    public function render()
    {
        $this->email = Auth::user()->email;
        $this->phone = Auth::user()->phone;
        $this->name = Auth::user()->name;
        
        $states = [
            'Andhra Pradesh',
            'Arunachal Pradesh',
            'Assam',
            'Goa',
            'Maharashtra'
        ];

        $cities = ['Amaravati', 'pune', 'Panaji', 'Mumbai'];
        $productCategories = Category::where('type','product')->get();
        $serviceCategories = Category::where('type','service')->get();
        return view('livewire.onboarding', compact('states', 'cities','productCategories','serviceCategories'))->extends('layouts.app');
    }
}
