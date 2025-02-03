<?php

namespace App\Livewire;

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

    // Step 2 fields for Business
    public $business_name;
    public $gst_number;
    public $business_address;
    public $google_map_link;

    // Define validation rules for step 2
    protected $rules = [
        'name' => 'nullable|string|max:255',
        'phone' => 'required|string|min:10|max:15',
        'email' => 'required|email',
        'state' => 'nullable|string',
        'city' => 'nullable|string',
        'business_name' => 'required_if:userType,business|string|max:255',
        'gst_number' => 'nullable|numeric|digits:15',
        'business_address' => 'nullable|string|max:255',
        'google_map_link' => 'nullable|url',
    ];

    // Define custom messages for validation errors
    protected $messages = [
        'name.required_if' => 'Please enter your name.',
        'phone.required' => 'Please enter a valid phone number.',
        'email.email' => 'Please enter a valid email address.',
        'state.required' => 'Please select a state.',
        'city.required' => 'Please select a city.',
        'business_name.required_if' => 'Please enter your business name.',
        'gst_number.numeric' => 'Please enter a valid GST number.',
        'business_address.required_if' => 'Please enter your business address.',
        'google_map_link.url' => 'Please enter a valid Google Map link.',
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
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function render()
    {
        $states = [
            'Andhra Pradesh',
            'Arunachal Pradesh',
            'Assam',
            'Goa',
            'Maharashtra'
        ];

        $cities = ['Amaravati', 'pune', 'Panaji', 'Mumbai'];

        return view('livewire.onboarding', compact('states', 'cities'))
            ->extends('layouts.app');
    }
}
