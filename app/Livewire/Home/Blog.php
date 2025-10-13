<?php

namespace App\Livewire\Home;

use App\Models\Blog as ModelsBlog;
use Illuminate\Support\Facades\Request;
use Laravel\Ui\Presets\React;
use Livewire\Component;

class Blog extends Component
{
    public $blogs = [];
    public $fullBlog = false;
    public $post;
    public $trendingBlogs = [];

    public function mount($slug = null)
    {
        if ($slug) {
            $this->fullBlog = true;
            $this->post = ModelsBlog::where('slug', $slug)->first();
            $this->trendingBlogs = ModelsBlog::orderBy('updated_at', 'DESC')->get();
        } else {
            $this->blogs = ModelsBlog::orderBy('updated_at', 'DESC')->get();
        }
    }

    public function viewBlog($slug)
    {
        $this->fullBlog = true;
        $this->post = ModelsBlog::where('slug', $slug)->first();
        $this->trendingBlogs = ModelsBlog::orderBy('updated_at', 'DESC')->get();
    }

    public function render()
    {
        return view('livewire.home.blog');
    }
}
