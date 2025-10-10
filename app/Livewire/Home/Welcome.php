<?php

namespace App\Livewire\Home;

use App\Models\Advertisement;
use App\Models\Blog;
use App\Models\BusinessCategory;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\ProductSellerReview;
use App\Models\State;
use App\Models\User;
use Illuminate\Http\Request;
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
        $this->selectedCity = $value;
    }

    #[On('selectedStatefun')]
    public function selectedStatefun($value)
    {
        $this->selectedState = $value;
    }

    public function boot(){
        $this->blogs = Blog::orderBy('updated_at', 'DESC')->limit(6)->get();
        $this->ads = Advertisement::all();
        $this->data = Category::where('type', $this->section)->get();
        if(!Auth::check()){
            Auth::logout();
        }
    }

    public function mount(Request $request)
    {
        $this->section = 'product';
    }

    public function viewBlog($slug)
    {
        return redirect()->route('blog', ['slug' => $slug]);
    }

    public function updatedSelectedCity()
    {
        $stateId = null;
        
        if ($this->selectedState) {
            $stateId = State::where('title', 'like', '%' . $this->selectedState . '%')->value('id');
        }
        
        $this->isOpen = true;
        $query = City::where('title', 'like', '%' . $this->selectedCity . '%')->limit(50);
        
        if ($stateId) {
            $query->where('state_id', $stateId);
        }
        
        $this->cities = $query->pluck('title')->toArray();
    }

    public function searchProduct($id = null)
    {
        $this->isOpen = false;
        
        if ($id) {
            $this->searchStarted = true;
            $query = User::with(['address', 'ratings']);
            
            if ($this->selectedCity) {
                $query->whereHas('address', function ($q) {
                    $q->where('addresses.city', 'LIKE', '%' . $this->selectedCity . '%')
                      ->orWhere('addresses.address', 'LIKE', '%' . $this->selectedCity . '%');
                });
            }
            
            $this->sellers = $query->whereHas('activeSubscription')
                ->whereHas('categories', function ($query) use ($id) {
                    $query->where('categories.id', $id);
                })
                ->whereNotIn('role', ['superadmin', 'admin'])
                ->where('offering', $this->section)
                ->addSelect([
                    'total_score' => ProductSellerReview::selectRaw('COUNT(communication_and_professionalism)')
                        ->whereColumn('seller_id', 'users.id')
                ])
                ->orderByDesc('total_score')
                ->get();
                
        } elseif ($this->selectedCity) {
            $this->searchStarted = true;
            $this->sellers = User::with(['address', 'categories', 'ratings'])
                ->whereHas('address', function ($query) {
                    $query->where('addresses.city', $this->selectedCity);
                })
                ->whereHas('activeSubscription')
                ->whereNotIn('role', ['superadmin', 'admin'])
                ->where('offering', $this->section)
                ->addSelect([
                    'total_score' => ProductSellerReview::selectRaw('COUNT(communication_and_professionalism)')
                        ->whereColumn('seller_id', 'users.id')
                ])
                ->orderByDesc('total_score')
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
        $this->isOpen = false;
    }

    public function toggle()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen && $this->selectedCity === '') {
            $this->updatedSelectedCity();
        }
    }

    /**
     * FIXED: Proper redirect handling with null check
     */
    public function dashboardRedirect()
    {
        $user = Auth::user();
        
        // Guard against unauthenticated users
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Check if onboarding is completed
        if (!$user->onboard_completed) {
            return redirect()->route('onboarding');
        }
        
        // Redirect based on user role
        return redirect()->route(match($user->role) {
            'individual' => 'user.profile',
            'business' => $user->offering === 'product' 
                ? 'business.profile' 
                : 'service.profile',
            'service' => 'service.profile',
            default => 'onboarding'
        });
    }

    public function setSection($test)
    {
        $this->section = $test;
        $this->data = Category::where('type', $this->section)->get();
        $this->clearSearch();
    }

    public function render()
    {
        return view('livewire.home.welcome')->extends('layouts.home');
    }
}