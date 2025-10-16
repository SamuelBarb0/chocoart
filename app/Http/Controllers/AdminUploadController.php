<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUploadController extends Controller
{
    /**
     * Mostrar formulario de upload para cualquier recurso
     */
    public function index(Request $request)
    {
        $resource = $request->query('resource', 'products');

        // Configuración por recurso
        $config = $this->getResourceConfig($resource);

        if (!$config) {
            abort(404, 'Recurso no encontrado');
        }

        $items = $config['model']::query()
            ->orderBy('order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.uploads', [
            'resource' => $resource,
            'config' => $config,
            'items' => $items,
        ]);
    }

    /**
     * Procesar upload de archivo principal
     */
    public function uploadMain(Request $request)
    {
        $request->validate([
            'resource' => 'required|string',
            'item_id' => 'required|integer',
            'file' => 'required|file|max:102400|mimes:jpg,jpeg,png,gif,webp,mp4,webm,mov',
        ]);

        $config = $this->getResourceConfig($request->resource);
        if (!$config) {
            return back()->with('error', 'Recurso no válido');
        }

        $item = $config['model']::findOrFail($request->item_id);

        try {
            // Eliminar archivo anterior si existe
            if ($item->{$config['field']} && Storage::disk('public')->exists($item->{$config['field']})) {
                Storage::disk('public')->delete($item->{$config['field']});
            }

            // Subir nuevo archivo
            $file = $request->file('file');
            $filename = time() . '-' . str_replace(' ', '-', $file->getClientOriginalName());
            $path = $file->storeAs($config['directory'], $filename, 'public');

            // Actualizar modelo
            $item->{$config['field']} = $path;
            $item->save();

            return back()->with('success', "Imagen principal subida para: {$item->name}");
        } catch (\Exception $e) {
            return back()->with('error', 'Error al subir archivo: ' . $e->getMessage());
        }
    }

    /**
     * Procesar upload de galería (múltiples imágenes)
     */
    public function uploadGallery(Request $request)
    {
        $request->validate([
            'resource' => 'required|string',
            'item_id' => 'required|integer',
            'files.*' => 'required|file|max:102400|mimes:jpg,jpeg,png,gif,webp',
        ]);

        $config = $this->getResourceConfig($request->resource);
        if (!$config || !$config['has_gallery']) {
            return back()->with('error', 'Este recurso no tiene galería');
        }

        $item = $config['model']::findOrFail($request->item_id);

        try {
            $currentGallery = $item->images ?? [];
            $newImages = [];

            foreach ($request->file('files') as $file) {
                $filename = time() . '-' . uniqid() . '-' . str_replace(' ', '-', $file->getClientOriginalName());
                $path = $file->storeAs($config['directory'], $filename, 'public');
                $newImages[] = $path;
            }

            // Agregar a la galería existente
            $item->images = array_merge($currentGallery, $newImages);
            $item->save();

            $count = count($newImages);
            return back()->with('success', "{$count} imagen(es) agregada(s) a la galería de: {$item->name}");
        } catch (\Exception $e) {
            return back()->with('error', 'Error al subir galería: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar imagen de galería
     */
    public function deleteGalleryImage(Request $request)
    {
        $request->validate([
            'resource' => 'required|string',
            'item_id' => 'required|integer',
            'image_path' => 'required|string',
        ]);

        $config = $this->getResourceConfig($request->resource);
        if (!$config || !$config['has_gallery']) {
            return back()->with('error', 'Este recurso no tiene galería');
        }

        $item = $config['model']::findOrFail($request->item_id);

        try {
            $gallery = $item->images ?? [];
            $imagePath = $request->image_path;

            // Eliminar del array
            $gallery = array_filter($gallery, fn($path) => $path !== $imagePath);
            $item->images = array_values($gallery);
            $item->save();

            // Eliminar archivo físico
            if (Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }

            return back()->with('success', 'Imagen eliminada de la galería');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar imagen: ' . $e->getMessage());
        }
    }

    /**
     * Configuración de recursos
     */
    private function getResourceConfig($resource)
    {
        $configs = [
            'products' => [
                'model' => \App\Models\Product::class,
                'title' => 'Productos',
                'field' => 'image',
                'directory' => 'products',
                'has_gallery' => true,
                'color' => '#e28dc4',
            ],
            'courses' => [
                'model' => \App\Models\Course::class,
                'title' => 'Cursos',
                'field' => 'image',
                'directory' => 'courses',
                'has_gallery' => true,
                'color' => '#81cacf',
            ],
            'posts' => [
                'model' => \App\Models\Post::class,
                'title' => 'Blog Posts',
                'field' => 'image',
                'directory' => 'posts',
                'has_gallery' => true,
                'color' => '#c6d379',
            ],
            'gallery' => [
                'model' => \App\Models\GalleryImage::class,
                'title' => 'Galería',
                'field' => 'image',
                'directory' => 'gallery',
                'has_gallery' => false,
                'color' => '#5f3917',
            ],
        ];

        return $configs[$resource] ?? null;
    }
}
