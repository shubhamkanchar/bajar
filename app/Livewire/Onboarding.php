<?php

namespace App\Livewire;

use App\Models\Address;
use App\Models\BusinessCategory;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
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
    public $stateOptions = [];
    public $cityOptions = [];
    public $gst_number;
    public $google_map_link;

    // Define validation rules for step 2
    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
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

        if ($this->userType == 'individual' && $this->step == 3) {
            try {
                $user = Auth::user();
                $user->name = $this->name;
                $user->phone = $this->phone;
                $user->type = 'individual';
                $user->role = 'individual';
                $user->save();

                $address = Address::firstOrNew(['user_id' => $user->id]);
                $address->city = $this->city;
                $address->state = $this->state;
                $address->save();
            } catch (Exception $e) {
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }

        if ($this->userType == 'business' && $this->step == 4) {
            try {
                $user = Auth::user();
                $user->name = $this->name;
                $user->phone = $this->phone;
                $user->type = 'business';
                $user->role = 'business';
                $user->offering = $this->offering;
                $user->gst = $this->gst_number;
                $user->save();

                $address = Address::firstOrNew(['user_id' => $user->id]);
                $address->address = $this->address;
                $address->city = $this->city;
                $address->state = $this->state;
                $address->pin_code = $this->pin_code;
                $address->map_link = $this->google_map_link;
                $address->save();

                foreach ($this->categoryIds as $category) {
                    BusinessCategory::updateOrCreate([
                        'user_id' => $user->id,
                        'category_id' => $category
                    ], [
                        'user_id' => $user->id,
                        'category_id' => $category
                    ]);
                }
            } catch (Exception $e) {
                $this->dispatch('notify', [
                    'type' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }
    }

    public function finalize()
    {
        $user = Auth::user();
        $user->onboard_completed = 1;
        $user->save();

        if ($user->role == 'individual') {
            return redirect()->route('home');
        } else if ($user->offering == 'business') {
            return redirect()->route('business.profile');
        } else if ($user->offering == 'service') {
            return redirect()->route('service.profile');
        }
    }

    public function setOffering($offering)
    {
        $this->offering = $offering;
        $this->categoryIds = [];
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
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

    public function setState(){
        foreach(config('state') as $key => $state){
            array_push($this->stateOptions,$key);
        }
    }

    public function setCity(){
        if($this->state){
            $this->cityOptions = config('state')[$this->state];
        }else{
            $this->cityOptions = [];
        }
    }

    public function render()
    {
        $this->setState();
        $this->setCity();
        if (Auth::user()->email) {
            $this->email = Auth::user()->email;
        }
        if (Auth::user()->phone) {
            $this->phone = Auth::user()->phone;
        }
        if (Auth::user()->name) {
            $this->name = Auth::user()->name;
        }
        

        $cities = [];
        foreach(config('state') as $key => $state){
            array_push($cities,$key);
        }
        $productCategories = Category::where('type', 'product')->get();
        $serviceCategories = Category::where('type', 'service')->get();
        return view('livewire.onboarding', compact('productCategories', 'serviceCategories'))->extends('layouts.app');
    }
}
