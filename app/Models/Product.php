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
        'whatsapp_message','available_from','available_to','whatsapp_enabled',
    ];

    protected $casts = [
        'images'   => 'array',
        'featured' => 'boolean',
        'published'=> 'boolean',
        'whatsapp_enabled' => 'boolean',
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

    /** ----- Helpers para WhatsApp ----- */
    public function isAvailableNow(): bool
    {
        // Si WhatsApp está deshabilitado, no está disponible
        if (!$this->whatsapp_enabled) {
            return false;
        }

        // Si no hay horarios configurados, está disponible 24/7
        if (!$this->available_from || !$this->available_to) {
            return true;
        }

        $now = now()->format('H:i:s');
        $from = $this->available_from;
        $to = $this->available_to;

        // Caso normal: from < to (ej. 09:00 a 18:00)
        if ($from <= $to) {
            return $now >= $from && $now <= $to;
        }

        // Caso especial: horario nocturno que cruza medianoche (ej. 22:00 a 02:00)
        return $now >= $from || $now <= $to;
    }

    public function getWhatsappUrl(): string
    {
        $phone = \App\Models\Setting::get('contact_whatsapp', '573001234567');
        $message = $this->whatsapp_message ?: "Hola! Me interesa el producto: {$this->name}";

        return "https://wa.me/{$phone}?text=" . urlencode($message);
    }
}
