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
        // Validación manual SIN usar Laravel validation (evita problemas con /tmp)
        if (!$request->has('resource') || !$request->has('item_id')) {
            return back()->with('error', 'Datos incompletos');
        }

        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            return back()->with('error', 'No se subió ningún archivo o hubo un error');
        }

        $config = $this->getResourceConfig($request->resource);
        if (!$config) {
            return back()->with('error', 'Recurso no válido');
        }

        $item = $config['model']::findOrFail($request->item_id);

        try {
            // Obtener info del archivo desde $_FILES directamente
            $uploadedFile = $_FILES['file'];
            $tmpName = $uploadedFile['tmp_name'];
            $originalName = basename($uploadedFile['name']);

            // Validación simple de extensión
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4', 'webm', 'mov'];
            if (!in_array($ext, $allowedExts)) {
                return back()->with('error', 'Tipo de archivo no permitido');
            }

            // Validación de tamaño (100MB)
            if ($uploadedFile['size'] > 104857600) {
                return back()->with('error', 'Archivo demasiado grande (máx 100MB)');
            }

            // Eliminar archivo anterior si existe
            if ($item->{$config['field']} && Storage::disk('public')->exists($item->{$config['field']})) {
                Storage::disk('public')->delete($item->{$config['field']});
            }

            // Crear nombre único
            $filename = time() . '-' . str_replace(' ', '-', $originalName);
            $directory = storage_path('app/public/' . $config['directory']);

            // Crear directorio si no existe
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Mover archivo directamente sin usar Laravel
            $destinationPath = $directory . '/' . $filename;
            if (!move_uploaded_file($tmpName, $destinationPath)) {
                return back()->with('error', 'Error al mover el archivo');
            }

            // Actualizar modelo
            $path = $config['directory'] . '/' . $filename;
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
        // Validación manual SIN usar Laravel validation
        if (!$request->has('resource') || !$request->has('item_id')) {
            return back()->with('error', 'Datos incompletos');
        }

        if (!isset($_FILES['files']) || empty($_FILES['files']['name'])) {
            return back()->with('error', 'No se subieron archivos');
        }

        $config = $this->getResourceConfig($request->resource);
        if (!$config || !$config['has_gallery']) {
            return back()->with('error', 'Este recurso no tiene galería');
        }

        $item = $config['model']::findOrFail($request->item_id);

        try {
            $currentGallery = $item->images ?? [];
            $newImages = [];
            $files = $_FILES['files'];
            $directory = storage_path('app/public/' . $config['directory']);

            // Crear directorio si no existe
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Procesar cada archivo
            $fileCount = count($files['name']);
            for ($i = 0; $i < $fileCount; $i++) {
                if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                    continue;
                }

                $tmpName = $files['tmp_name'][$i];
                $originalName = basename($files['name'][$i]);

                // Validación de extensión
                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (!in_array($ext, $allowedExts)) {
                    continue;
                }

                // Validación de tamaño (100MB)
                if ($files['size'][$i] > 104857600) {
                    continue;
                }

                // Crear nombre único
                $filename = time() . '-' . uniqid() . '-' . str_replace(' ', '-', $originalName);
                $destinationPath = $directory . '/' . $filename;

                // Mover archivo
                if (move_uploaded_file($tmpName, $destinationPath)) {
                    $newImages[] = $config['directory'] . '/' . $filename;
                }
            }

            if (empty($newImages)) {
                return back()->with('error', 'No se pudieron subir los archivos');
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
        // Sin validación de Laravel
        if (!$request->has('resource') || !$request->has('item_id') || !$request->has('image_path')) {
            return back()->with('error', 'Datos incompletos');
        }

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
