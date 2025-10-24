<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'color',
        'order',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    /**
     * Boot method to auto-generate slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Scope para filtrar por tipo
     */
    public function scopeOfType($query, string $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope para categorías activas
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Relaciones con productos
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Relaciones con cursos
     */
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    /**
     * Relaciones con posts
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Relaciones con galería
     */
    public function galleryImages()
    {
        return $this->hasMany(GalleryImage::class);
    }
}
