<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category_id',
        'excerpt',
        'content',
        'icon',
        'gradient',
        'read_time',
        'published',
        'published_at',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_image',
    ];

    protected $casts = [
        'published' => 'boolean',
        'published_at' => 'date',
    ];

    /**
     * Scope para filtrar publicaciones publicadas.
     */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    /**
     * Devuelve la URL del post.
     */
    public function getUrlAttribute(): string
    {
        return route('blog.post', $this->slug);
    }

    /**
     * Boot method para auto-generar slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
            if (empty($post->meta_title)) {
                $post->meta_title = $post->title;
            }
            if (empty($post->meta_description)) {
                $post->meta_description = $post->excerpt;
            }
        });
    }

    /**
     * Relación con Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
