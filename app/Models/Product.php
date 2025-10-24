<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','description','price','category_id',
        'icon','gradient','image','images',
        'featured','published','order',
        'meta_title','meta_description','meta_keywords',
    ];

    protected $casts = [
        'images'   => 'array',
        'featured' => 'boolean',
        'published'=> 'boolean',
        'price'    => 'decimal:2',
        'order'    => 'integer',
    ];

    /** Scopes */
    public function scopePublished($q){ return $q->where('published', true); }
    public function scopeFeatured($q){ return $q->where('featured', true); }

    /** Slug & meta por defecto */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            if (empty($product->slug)) $product->slug = Str::slug($product->name);
            if (empty($product->meta_title)) $product->meta_title = $product->name;
            if (empty($product->meta_description)) $product->meta_description = $product->description;
        });
    }

    /** ----- Mutators: guardar SIEMPRE ruta relativa ----- */
    public function setImageAttribute($value): void   { $this->attributes['image'] = $this->stripStoragePrefix($value); }
    public function setIconAttribute($value): void    { $this->attributes['icon']  = $this->stripStoragePrefix($value); }

    public function setImagesAttribute($value): void
    {
        if (is_array($value)) {
            $value = array_map(fn($v) => $this->stripStoragePrefix($v), $value);
        } elseif (is_string($value)) {
            $decoded = json_decode($value, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $value = array_map(fn($v) => $this->stripStoragePrefix($v), $decoded);
            } else {
                $value = [$this->stripStoragePrefix($value)];
            }
        } elseif (is_null($value)) {
            $value = [];
        }
        $this->attributes['images'] = json_encode($value);
    }

    protected function stripStoragePrefix(?string $path): ?string
    {
        if (!is_string($path) || $path === '') return $path;
        $path = preg_replace('#^https?://[^/]+/storage/#', '', $path); // http://127.0.0.1:8000/storage/...
        $path = preg_replace('#^/?storage/#', '', $path);              // /storage/...
        return $path;
    }

    /** ----- Accessors: URL pública lista para la vista ----- */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? \Storage::disk('public')->url($this->image) : null;
    }

    public function getIconUrlAttribute(): ?string
    {
        return $this->icon ? \Storage::disk('public')->url($this->icon) : null;
    }

    public function getImagesUrlsAttribute(): array
    {
        $arr = is_array($this->images) ? $this->images : [];
        return array_map(fn($p) => \Storage::disk('public')->url($p), $arr);
    }

    /** ----- Relación con Category ----- */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
