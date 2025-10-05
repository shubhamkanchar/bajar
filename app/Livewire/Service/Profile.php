<?php

namespace App\Livewire\Service;

use App\Models\BusinessCategory;
use App\Models\BusinessTime;
use App\Models\Category;
use App\Models\ProductSellerReview;
use App\Models\Service;
use App\Models\ServiceImage;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Razorpay\Api\Api;

class Profile extends Component
{
    use WithFileUploads;

    public $isEdit = false;
    public $editServiceId;
    public $selectedCategory = 'all';
    public $user;
    public $allTags = [];
    public $sliderStatus = '';
    
    #[
        Validate(
            rule: ['service_images.*' => 'required|image|max:1024'],
            message: [
                'service_images.*.required' => 'Please add image.',
                'service_images.*.image' => 'The image must be a valid image file.',
                'service_images.*.max' => 'The image cannot be larger than 1MB.',
            ]
        )
    ]
    public $service_images = [
        'service_image1' => null,
        'service_image2' => null,
        'service_image3' => null,
        'service_image4' => null,
        'service_image5' => null,
        'service_image6' => null,
    ];

    #[Validate(rule: 'required', message: 'Work brief is required')]
    public $work_brief;
    #[Validate(rule: 'required', message: 'Description is required')]
    public $description;
    #[Validate(rule: 'required', message: 'Please select category')]
    public $category;
    #[Validate(rule: 'required', message: 'Please select product tag/group')]
    public $service_tag = '';

    public function mount(Request $request){

        if(!Auth::user()){
            Auth::logout();
            session()->flush();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login');  
        }

        $this->user = Auth::user();
        $this->allTags = Service::where('user_id',Auth::user()->id)->pluck('service_tag')->toArray();

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
    }

    public function openSlider(){
        $this->sliderStatus = 'open';
    }

    public function closeSlider(){
        $this->sliderStatus = 'close';
        $this->resetService();
    }

    #[Computed]
    public function allServices()
    {
        if ($this->selectedCategory == 'all') {
            // return Service::with('images')->where('user_id', auth()->id())->get()->groupBy('category.title');
           return Service::with(['images', 'category'])
                ->where('user_id', auth()->id())
                ->get()
                ->groupBy(function ($service) {
                    return $service->category?->title . ' : ' . $service->service_tag;
                });
        }
        // return Service::with('images')->where(['user_id' => auth()->id(), 'category_id' => $this->selectedCategory])->get()->groupBy('category.title');
        return Service::with(['images', 'category']) // eager-load relationships
                ->where([
                    'user_id' => auth()->id(),
                    'category_id' => $this->selectedCategory,
                ])
                ->get()
                ->groupBy(function ($service) {
                    return $service->category?->title . ' : ' . $service->service_tag;
                });
    }

    #[Computed]
    public function bussinessTime()
    {
        $time = BusinessTime::where([
            'user_id' => Auth::user()->id,
            'day' => date("l")
        ])->first();
        if($time && $time['open_time'] && $time['close_time']) {
            return date("g:i A", strtotime($time['open_time'])).' - '.date("g:i A", strtotime($time['close_time']));
        }
        return 'Closed';
    }
    
    #[Computed]
    public function categories()
    {
        $businessCategories = BusinessCategory::where('user_id',Auth::user()->id)->pluck('category_id');
        return Category::where('type', 'service')->whereIn('id',$businessCategories)->get();
    }

    
    #[Computed]
    public function bussinessRatingsCount()
    {
        $data = ProductSellerReview::where([
            'seller_id' => $this->user->id,
            'is_expert' => 1
        ])
        ->count();
        return $data;
    }

    #[Computed]
    public function businessCategories() {
        $ids = Service::where('user_id', auth()->id())->pluck('category_id');
        return Category::where('type', 'service')->whereIn('id', $ids)->get();
    }

    public function changeCategory($value) {
        $this->selectedCategory = $value;
    }

    public function deleteService()
    {
        $service = Service::findOrFail($this->editServiceId);
        $serviceImages = $service->images();
        foreach($serviceImages as $image) {
            $imagePath = public_path("storage/{$image->path}");

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $serviceImages->delete();
        $service->delete();
        $this->resetService();
        $this->dispatch('serviceDeleted', [
            'type' => 'success',
            'message' => 'Sevice deleted! '
        ]);
    }

    public function limitText($text, $limit = 40) {
        if (mb_strlen($text) > $limit) {
            return mb_substr($text, 0, $limit) . '...';
        }
        return $text;
    }

    public function resetService() {
        $this->reset([
            'work_brief',
            'service_tag',
            'service_images',
            'description',
            'category',
            'editServiceId',
            'isEdit'
        ]);
    }

    public function editService($id) {
        $service = Service::with('images')->findOrFail($id);
        $this->editServiceId = $id;
        $this->description = $service->description;
        $this->category = $service->category_id;
        $this->service_tag = $service->service_tag;
        $this->work_brief = $service->work_brief;
    
        foreach ($service->images as $index => $image) {
            $this->service_images['service_image' . ($index + 1)] = $image->path;
        }

        $this->isEdit = true;
        $this->openSlider();
    }

    public function messages()
    {
        return [
            'service_images.*.image' => 'Please add image.',
            'service_images.*.image' => 'The image must be a valid image file.',
            'service_images.*.max' => 'The image cannot be larger than 1MB.',
        ];
    }
    
    public function saveService()  {

        $rules = [
            'description' => 'required',
            'category' => 'required',
            'service_tag' => 'required',
            'work_brief' => 'required',
        ];
    
        if (!$this->isEdit) {
            $rules['service_images.service_image1'] = 'required|image|max:1024';
        } else {
            $rules['service_images.service_image1'] = 'required|max:2048';
        }
        $this->validate($rules);

        $service = $this->isEdit ? Service::findOrFail($this->editServiceId) : new Service();
        $service->work_brief = $this->work_brief;
        $service->category_id = $this->category;
        $service->description = $this->description;
        $service->service_tag = $this->service_tag;
        $service->user_id = auth()->id();
        $service->is_approved = 0;
        $service->save();

        if ($this->isEdit) {
            $existingImages = $service->images()->orderBy('order')->get();

            foreach ($existingImages as $index => $existingImage) {
                $key = 'service_image' . ($index + 1);
                
                if (!empty($this->service_images[$key])) {
                    $image = $this->service_images[$key];
                    $path = is_string($image) ? $image : $image->store('service', 'public');
                    $existingImage->update(['path' => $path]);
                }
            }
        } else {
            foreach (range(1, 6) as $index) {
                $key = 'service_image' . $index;

                if (!empty($this->service_images[$key])) {
                    $image = $this->service_images[$key];
                    $path = $image->store('products', 'public');
                    ServiceImage::create([
                        'service_id' => $service->id,
                        'order' => $index,
                        'path' => $path
                    ]);
                }
            }
        }

        $this->dispatch('serviceUpdated', [
            'type' => 'success',
            'message' => $this->isEdit ? 'Service updated successfully' : 'Service added successfully'
        ]);

        $this->resetService();

    }

    // Method to remove an image
    public function removeImage($image)
    {
        $this->service_images[$image] = null;
    }

    public function addNewTag(string $tag)
    {
        $tag = trim($tag);

        if ($tag === '' || in_array($tag, $this->allTags)) {
            return;
        }

        // Optionally persist to DB here...
        $this->allTags[] = $tag;

        // Set as selected
        $this->service_tag = $tag;
    }

    public function render()
    {
        return view('livewire.service.profile')->extends('layouts.profile-layout');
    }
}
