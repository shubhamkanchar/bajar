<?php

namespace App\Livewire\Service;

use App\Models\BusinessTime;
use App\Models\Category;
use App\Models\Service;
use App\Models\ServiceImage;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    public $isEdit = false;
    public $editServiceId;
    public $selectedCategory = 'all';
    public $user;
    
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
    public $service_tag_group_id;

    public function mount(){
        $this->user = Auth::user();
    }

    #[Computed]
    public function allServices()
    {
        if($this->selectedCategory == 'all') {
            return Service::with('images')->where('user_id', auth()->id())->get();
        }
        return Service::with('images')->where(['user_id' => auth()->id(), 'category_id' => $this->selectedCategory])->get();
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
        return Category::where('type', 'service')->get();
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
            'service_tag_group_id',
            'service_images',
            'description',
            'category'
        ]);
    }

    public function editService($id) {
        $service = Service::with('images')->findOrFail($id);
        $this->editServiceId = $id;
        $this->description = $service->description;
        $this->category = $service->category_id;
        $this->service_tag_group_id = $service->service_tag_group_id;
        $this->work_brief = $service->work_brief;
    
        foreach ($service->images as $index => $image) {
            $this->service_images['service_image' . ($index + 1)] = $image->path;
        }

        $this->isEdit = true;
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
            'service_tag_group_id' => 'required',
            'work_brief' => 'required',
        ];
    
        // If creating a new product, ensure images are uploaded
        if (!$this->isEdit) {
            $rules['service_images.*'] = 'required|image|max:1024';
        } else {
            // If editing, allow either a file upload or an existing image string
            $rules['service_images.*'] = 'required|max:2048';
        }
        $this->validate($rules);

        $service = $this->isEdit ? Service::findOrFail($this->editServiceId) : new Service();
        $service->work_brief = $this->work_brief;
        $service->category_id = $this->category;
        $service->description = $this->description;
        $service->service_tag_group_id = $this->service_tag_group_id;
        $service->user_id = auth()->id();
        $service->save();

        if ($this->isEdit) {
            $existingImages = $service->images()->orderBy('order')->get();

            foreach ($existingImages as $index => $existingImage) {
                $key = 'service_image' . ($index + 1);

                if (!empty($this->service_images[$key])) {
                    $image = $this->service_images[$key];

                    // Get new image path if uploaded, otherwise keep old path
                    $path = is_string($image) ? $image : $image->store('products', 'public');

                    // Update only the path for existing images
                    $existingImage->update(['path' => $path]);
                }
            }
        } else {
            // Ensure exactly 6 images are created in order for new product
            foreach (range(1, 6) as $index) {
                $key = 'service_image' . $index;

                if (!empty($this->service_images[$key])) {
                    $image = $this->service_images[$key];

                    // Store the image
                    $path = $image->store('products', 'public');

                    // Create new image record with correct order
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

        $this->reset([
            'work_brief',
            'service_tag_group_id',
            'service_images',
            'description',
            'category'
        ]);
    }

    // Method to remove an image
    public function removeImage($image)
    {
        $this->service_images[$image] = null;
    }

    public function render()
    {
        return view('livewire.service.profile')->extends('layouts.profile-layout');
    }
}
