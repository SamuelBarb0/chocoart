<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    use HasFactory;

    protected $table = 'gallery_images';

    protected $fillable = [
        'title','description','image','category',
        'gradient','featured','order',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'order'    => 'integer',
    ];

    /** Mutator: guardar ruta relativa */
    public function setImageAttribute($value): void
    {
        if (is_string($value)) {
            $value = preg_replace('#^https?://[^/]+/storage/#', '', $value);
            $value = preg_replace('#^/?storage/#', '', $value);
        }
        $this->attributes['image'] = $value;
    }

    /** Accessors */
    public function getGradientClassAttribute(): string
    {
        return $this->gradient ?: 'from-[#e28dc4] to-[#81cacf]';
    }

    public function getCategorySlugAttribute(): string
    {
        return str($this->category ?? 'otros')->lower()->slug('-');
    }

    public function getImageUrlAttribute(): ?string
    {
        if (!$this->image) {
            return null;
        }

        // Si ya es URL completa, retornarla
        if (str($this->image)->startsWith(['http://', 'https://'])) {
            return $this->image;
        }

        // Generar URL usando asset con storage/
        return asset('storage/' . $this->image);
    }

    /** Scopes */
    public function scopeFeatured($q){ return $q->where('featured', true); }
    public function scopeOrdered($q){ return $q->orderBy('order')->orderBy('id'); }
}
