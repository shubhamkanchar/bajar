<?php

namespace App\Livewire\Admin;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;

class Blogs extends Component
{
    use WithFileUploads;

    public $isEdit;
    public $blog_image;
    public $is_approved;
    public $orderBy = 'recent';
    public $start_date;
    public $end_date;
    public $currentPage = 1;
    public $perPage = 10;
    public $totalPage = 1;
    public $sliderStatus, $title, $description, $editBlogData;


    #[Computed()]
    public function products()
    {
        $query = Blog::query();

        if ($this->orderBy === 'recent') {
            $query->orderBy('created_at', 'desc');
        } elseif ($this->orderBy === 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($this->orderBy === 'date-range') {
            if (!empty($this->start_date) && !empty($this->end_date)) {
                $query->whereBetween('created_at', [
                    Carbon::parse($this->start_date)->startOfDay(),
                    Carbon::parse($this->end_date)->endOfDay()
                ]);
            } elseif (!empty($this->start_date)) {
                $query->whereDate('created_at', '>=', Carbon::parse($this->start_date)->startOfDay());
            } elseif (!empty($this->end_date)) {
                $query->whereDate('created_at', '<=', Carbon::parse($this->end_date)->endOfDay());
            }
        }

        $totalRecord = $query->count();
        $this->totalPage = ceil($totalRecord / $this->perPage);

        $startLimit = ($this->currentPage - 1) * $this->perPage;

        $query->skip($startLimit)->take($this->perPage);

        $filteredProducts = $query->get();

        return $filteredProducts;
    }

    public function updatedOrderBy($value)
    {
        if ($value != 'date-range') {
            $this->reset(['currentPage', 'perPage', 'totalPage', 'start_date', 'end_date']);
        }
    }

    public function updatedStartDate($value)
    {
        $this->orderBy = 'date-range';
        $this->reset(['currentPage', 'perPage', 'totalPage']);
    }

    public function openSlider()
    {
        $this->sliderStatus = 'open';
        $this->reset(['title', 'description', 'blog_image']);
    }

    public function closeSlider()
    {
        $this->sliderStatus = '';
    }

    public function updatedEndDate($value)
    {
        $this->orderBy = 'date-range';
        $this->reset(['currentPage', 'perPage', 'totalPage']);
    }

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|min:10',
        'blog_image' => 'nullable',
    ];

    public function editBlog($id)
    {
        $this->editBlogData = Blog::where('id', $id)->first();
        $this->sliderStatus = 'open';
        $this->title = $this->editBlogData->title;
        $this->description = $this->editBlogData->description;
        $this->blog_image = $this->editBlogData->blog_image;
        $this->isEdit = true;
    }

    public function updateBlog($id)
    {
        $validated = $this->validate();
        if ($this->blog_image && gettype($this->blog_image) != 'string') {
            $validated['blog_image'] = $this->blog_image->store('images', 'public');;
        }else{
            $validated['blog_image'] = $this->blog_image;
        }
        $validated['user_id'] = auth()->id();
        $validated['is_published'] = 1;
        $validated['published_at'] = now();
        $blog = Blog::where('id', $id)->update($validated);
        if ($blog) {
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Blog Created Successfully',
            ]);
        } else {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
        $this->reset(['title', 'description', 'blog_image']);
        $this->isEdit = false;
        $this->editBlogData = '';
    }

    public function publishBlog()
    {
        $validated = $this->validate();

        if ($this->blog_image && gettype($this->blog_image) != 'string') {
            $validated['blog_image'] = $this->blog_image->store('images', 'public');;
        }

        $validated['user_id'] = auth()->id();
        $validated['is_published'] = 1;
        $validated['published_at'] = now();

        $blog = Blog::create($validated);
        if ($blog) {
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Blog Created Successfully',
            ]);
        } else {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Something went wrong',
            ]);
        }
        $this->reset(['title', 'description', 'blog_image']);
    }

    public function textWrap($text)
    {
        return Str::limit($text, 80, '...');
    }

    public function titleWrap($text)
    {
        return Str::limit($text, 30, '...');
    }

    public function deleteProductSeller($uuid)
    {
        $data = Blog::where('id',$uuid)->first();
        if($data->delete()){
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Blog deleted successfully',
            ]);
        }else{
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Something went wrong',
            ]);
        } 
        $this->reset(['title', 'description', 'blog_image']);
        $this->isEdit = false;
        $this->editBlogData = '';
        $this->sliderStatus ='';
    }

    public function render()
    {
        return view('livewire.admin.blogs')->extends('layouts.admin');
    }
}
