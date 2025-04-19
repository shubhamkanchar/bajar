<?php

namespace App\Livewire\Home;

use App\Models\Advertisement;
use App\Models\Blog;
use App\Models\Category;
use App\Models\City;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Welcome extends Component
{

    public $section, $ads;
    public $data = [];
    public $search = '';
    public $isOpen = false;
    public $cities = [];
    public $selectedCity = '';
    public $productName;
    public $sellers = [];
    public $blogs = [];
    public $searchStarted = false;


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
        $this->isOpen = true;
        $this->cities = City::where('title', 'like', '%' . $this->search . '%')
            ->limit(50)
            ->pluck('title')
            ->toArray();
    }

    public function searchProduct()
    {
        if ($this->selectedCity) {
            $this->searchStarted = true;
            $this->sellers = User::with(['address', 'category'])
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
            if ($user->type == 'individual') {
                return route('user.profile');
            } else if ($user->type == 'business') {
                return route('business.profile');
            } else if ($user->type == 'service') {
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
