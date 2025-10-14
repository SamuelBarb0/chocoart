<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'page','meta_title','meta_description','meta_keywords',
        'og_title','og_description','og_image','og_type','schema_markup',
    ];

    public static function forPage(string $page): ?self
    { return static::where('page', $page)->first(); }

    public static function getOrCreateForPage(string $page): self
    {
        return static::firstOrCreate(['page' => $page], [
            'meta_title' => 'Chocoart - ' . ucfirst($page),
            'meta_description' => 'Página de ' . $page,
        ]);
    }

    /** Normaliza y expone URL pública de OG */
    public function setOgImageAttribute($value): void
    {
        if (is_string($value)) {
            $value = preg_replace('#^https?://[^/]+/storage/#', '', $value);
            $value = preg_replace('#^/?storage/#', '', $value);
        }
        $this->attributes['og_image'] = $value;
    }

    public function getOgImageUrlAttribute(): ?string
    {
        return $this->og_image ? \Storage::disk('public')->url($this->og_image) : null;
    }
}
