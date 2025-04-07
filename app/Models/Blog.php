<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'excerpt', 'blog_image', 'is_published', 'published_at', 'user_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($blog) {
            if (empty($blog->slug)) {
                $slug = Str::slug($blog->title);
                $originalSlug = $slug;
                $counter = 1;

                // Loop to ensure uniqueness
                while (static::where('slug', $slug)->exists()) {
                    $slug = $originalSlug . '-' . $counter++;
                }

                $blog->slug = $slug;
            }
        });
    }

}
