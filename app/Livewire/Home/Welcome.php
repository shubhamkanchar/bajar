<?php

namespace App\Livewire\Home;

use App\Models\Advertisement;
use App\Models\Blog;
use App\Models\BusinessCategory;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;

class Welcome extends Component
{

    public $section, $ads;
    public $data = [];
    public $search = '';
    public $isOpen = false;
    public $cities = [];
    public $selectedCity = '';
    public $selectedState = '';
    public $productName;
    public $sellers = [];
    public $blogs = [];
    public $searchStarted = false;


    #[On('selectedCityfun')]
    public function selectedCityfun($value)
    {
        $this->selectedCity = $value;  // Set property from JS
    }

    #[On('selectedStatefun')]
    public function selectedStatefun($value)
    {
        $this->selectedState = $value;  // Set property from JS
    }

    public function mount()
    {
        $this->blogs = Blog::orderBy('updated_at', 'DESC')->limit(6)->get();
        $this->ads = Advertisement::all();
        $this->section = 'product';
        $this->data = Category::where('type', $this->section)->get();
    }

    public function viewBlog($slug)
    {
        return redirect()->route('blog', ['slug' => $slug]);
    }

    public function updatedSearch()
    {
        if ($this->selectedState) {
            $stateId = State::where('title', 'like', '%' . $this->selectedState . '%')->value('id');
        }
        $this->isOpen = true;
        $query = City::where('title', 'like', '%' . $this->search . '%')
            ->limit(50);
        if (isset($stateId)) {
            $query->where('state_id', $stateId);
        }
        $this->cities = $query->pluck('title')->toArray();
    }

    public function searchProduct($id = NULL)
    {
        if ($id) {
            $this->searchStarted = true;
            $this->sellers = User::with(['address', 'ratings'])
                ->whereHas('address', function ($query) {
                    $query->where('addresses.city', $this->selectedCity);
                })
                ->whereHas('categories', function ($query) use ($id) {
                    $query->where('categories.id', $id);
                })
                ->whereNotIn('role', ['superadmin', 'admin'])
                ->where('offering', $this->section)
                ->get();
        } elseif ($this->selectedCity) {
            $this->searchStarted = true;
            $this->sellers = User::with(['address', 'categories', 'ratings'])
                ->whereHas('address', function ($query) {
                    $query->where('addresses.city', $this->selectedCity);
                })
                ->whereNotIn('role', ['superadmin', 'admin'])
                ->where('offering', $this->section)
                ->get();
        } else {
            $text = $this->section == 'product' ? 'product sellers' : 'service providers';
            $this->dispatch('notify', [
                'type' => 'Error',
                'message' => 'Please select city to search ' . $text
            ]);
        }
    }

    public function clearSearch()
    {
        $this->searchStarted = false;
        $this->productName = '';
        $this->sellers = [];
    }

    public function searchRestart()
    {
        $this->searchStarted = false;
    }

    public function selectCity($city)
    {
        $this->selectedCity = $city;
        $this->search = '';
        $this->isOpen = false;
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen && $this->search === '') {
            $this->updatedSearch();
        }
    }

    public function dashboardRedirect()
    {
        $user = Auth::user();
        if ($user->onboard_completed) {
            if ($user->role == 'individual') {
                return route('user.profile');
            } else if ($user->role == 'business') {
                return route('business.profile');
            } else if ($user->role == 'service') {
                return route('service.profile');
            }
        } else {
            return route('onboarding');
        }
    }

    public function setSection($test)
    {
        $this->section = $test;
        $this->data = Category::where('type', $this->section)->get();
    }

    public function render()
    {

        return view('livewire.home.welcome')->extends('layouts.home');
    }
}
