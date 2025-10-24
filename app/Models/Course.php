<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'level',
        'category_id',
        'price',
        'duration_hours',
        'icon',
        'color',
        'image',
        'published',
        'order',
        'features',
        'requirements',
        'includes',
        'start_date',
        'max_students',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'badge',
    ];

    protected $casts = [
        'features' => 'array',
        'requirements' => 'array',
        'includes' => 'array',
        'published' => 'boolean',
        'price' => 'decimal:2',
        'order' => 'integer',
        'duration_hours' => 'integer',
        'max_students' => 'integer',
        'start_date' => 'date',
    ];

    /**
     * Scopes para filtrar cursos
     */
    public function scopePublished($query)
    {
        return $query->where('published', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeByLevel($query, $level)
    {
        return $query->where('level', $level);
    }

    /**
     * Boot method para auto-generar slug y meta tags
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($course) {
            if (empty($course->slug)) {
                $course->slug = Str::slug($course->title);
            }
            if (empty($course->meta_title)) {
                $course->meta_title = $course->title;
            }
            if (empty($course->meta_description)) {
                $course->meta_description = $course->description;
            }
        });
    }

    /**
     * Mutators: guardar SIEMPRE ruta relativa sin prefijo /storage/
     */
    public function setImageAttribute($value): void
    {
        $this->attributes['image'] = $this->stripStoragePrefix($value);
    }

    public function setIconAttribute($value): void
    {
        $this->attributes['icon'] = $this->stripStoragePrefix($value);
    }

    protected function stripStoragePrefix(?string $path): ?string
    {
        if (!is_string($path) || $path === '') {
            return $path;
        }

        // Remover prefijos de URL completa o /storage/
        $path = preg_replace('#^https?://[^/]+/storage/#', '', $path);
        $path = preg_replace('#^/?storage/#', '', $path);

        return $path;
    }

    /**
     * Accessors: URL pública lista para la vista
     */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? \Storage::disk('public')->url($this->image) : null;
    }

    public function getIconUrlAttribute(): ?string
    {
        return $this->icon ? \Storage::disk('public')->url($this->icon) : null;
    }

    /**
     * Obtener la URL del curso
     */
    public function getUrlAttribute(): string
    {
        return route('cursos') . '#curso-' . $this->slug;
    }

    /**
     * Formatear el precio
     */
    public function getFormattedPriceAttribute(): string
    {
        return $this->price ? '$' . number_format($this->price, 0, ',', '.') : 'Consultar';
    }

    /**
     * Formatear la duración
     */
    public function getFormattedDurationAttribute(): string
    {
        if (!$this->duration_hours) {
            return 'A consultar';
        }

        return $this->duration_hours . ' ' . ($this->duration_hours === 1 ? 'hora' : 'horas');
    }

    /**
     * Formatear capacidad máxima
     */
    public function getFormattedCapacityAttribute(): string
    {
        return $this->max_students
            ? $this->max_students . ' ' . ($this->max_students === 1 ? 'persona' : 'personas')
            : 'Flexible';
    }

    /**
     * Verificar si el curso está disponible
     */
    public function isAvailable(): bool
    {
        if (!$this->published) {
            return false;
        }

        if ($this->start_date && $this->start_date->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Obtener el color del badge según el nivel
     */
    public function getLevelColorAttribute(): string
    {
        return match($this->level) {
            'Principiante' => 'from-[#c6d379] to-[#81cacf]', // Verde a menta
            'Intermedio' => 'from-[#81cacf] to-[#e28dc4]',   // Menta a rosa
            'Avanzado' => 'from-[#e28dc4] to-[#5f3917]',     // Rosa a chocolate
            'Todos los niveles' => 'from-[#c6d379] to-[#e28dc4]', // Verde a rosa
            default => 'from-[#81cacf] to-[#c6d379]',        // Default
        };
    }

    /**
     * Relación con Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
