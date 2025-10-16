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
public function uploadMain(Request $request)
{
    // FORZAR configuración del directorio temporal
    $tmpDir = '/home/yjopjnuw/tmp/php-uploads';
    ini_set('upload_tmp_dir', $tmpDir);
    ini_set('sys_temp_dir', $tmpDir);
    
    \Log::info('=== INICIO uploadMain ===');
    \Log::info('📁 Upload tmp dir configurado: ' . ini_get('upload_tmp_dir'));
    \Log::info('📁 Sys temp dir: ' . sys_get_temp_dir());
    \Log::info('✓ ¿Directorio temporal existe?: ' . (is_dir($tmpDir) ? 'SÍ' : 'NO'));
    \Log::info('✓ ¿Directorio temporal escribible?: ' . (is_writable($tmpDir) ? 'SÍ' : 'NO'));
    
    \Log::info('Request data:', $request->all());
    \Log::info('$_FILES:', $_FILES);

    // Validación manual SIN usar Laravel validation (evita problemas con /tmp)
    if (!$request->has('resource') || !$request->has('item_id')) {
        \Log::error('ERROR: Datos incompletos - resource o item_id faltante');
        return back()->with('error', 'Datos incompletos');
    }

    \Log::info('Verificando $_FILES...');
    if (!isset($_FILES['file'])) {
        \Log::error('ERROR: $_FILES[file] no existe');
        return back()->with('error', 'No se recibió ningún archivo');
    }

    if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
        $errorCode = $_FILES['file']['error'];
        \Log::error('ERROR: Upload error code: ' . $errorCode);
        \Log::error('Error messages: ' . $this->getUploadErrorMessage($errorCode));
        return back()->with('error', 'Error al subir archivo (código: ' . $errorCode . ')');
    }

    $config = $this->getResourceConfig($request->resource);
    if (!$config) {
        \Log::error('ERROR: Recurso no válido: ' . $request->resource);
        return back()->with('error', 'Recurso no válido');
    }
    \Log::info('Config obtenida:', $config);

    $item = $config['model']::findOrFail($request->item_id);
    \Log::info('Item encontrado: ' . $item->name . ' (ID: ' . $item->id . ')');

    try {
        // Obtener info del archivo desde $_FILES directamente
        $uploadedFile = $_FILES['file'];
        $tmpName = $uploadedFile['tmp_name'];
        $originalName = basename($uploadedFile['name']);

        \Log::info('Archivo: ' . $originalName);
        \Log::info('Temp path: ' . $tmpName);
        \Log::info('Size: ' . $uploadedFile['size'] . ' bytes');

        // Validación simple de extensión
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'mp4', 'webm', 'mov'];
        \Log::info('Extensión: ' . $ext);

        if (!in_array($ext, $allowedExts)) {
            \Log::error('ERROR: Extensión no permitida: ' . $ext);
            return back()->with('error', 'Tipo de archivo no permitido');
        }

        // Validación de tamaño (100MB)
        if ($uploadedFile['size'] > 104857600) {
            \Log::error('ERROR: Archivo demasiado grande: ' . $uploadedFile['size']);
            return back()->with('error', 'Archivo demasiado grande (máx 100MB)');
        }

        // Eliminar archivo anterior si existe
        if ($item->{$config['field']} && Storage::disk('public')->exists($item->{$config['field']})) {
            \Log::info('Eliminando archivo anterior: ' . $item->{$config['field']});
            Storage::disk('public')->delete($item->{$config['field']});
        }

        // Crear nombre único
        $filename = time() . '-' . str_replace(' ', '-', $originalName);
        $directory = storage_path('app/public/' . $config['directory']);
        \Log::info('Directorio destino: ' . $directory);
        \Log::info('Filename: ' . $filename);

        // Crear directorio si no existe
        if (!is_dir($directory)) {
            \Log::info('Creando directorio...');
            mkdir($directory, 0755, true);
        }

        // Mover archivo directamente sin usar Laravel
        $destinationPath = $directory . '/' . $filename;
        \Log::info('Ruta completa destino: ' . $destinationPath);
        \Log::info('¿Archivo temporal existe? ' . (file_exists($tmpName) ? 'SÍ' : 'NO'));
        \Log::info('¿Directorio escribible? ' . (is_writable($directory) ? 'SÍ' : 'NO'));

        if (!move_uploaded_file($tmpName, $destinationPath)) {
            \Log::error('ERROR: move_uploaded_file() falló');
            \Log::error('Último error PHP: ' . print_r(error_get_last(), true));
            return back()->with('error', 'Error al mover el archivo');
        }

        \Log::info('✅ Archivo movido exitosamente');
        \Log::info('¿Archivo existe en destino? ' . (file_exists($destinationPath) ? 'SÍ' : 'NO'));

        // Actualizar modelo
        $path = $config['directory'] . '/' . $filename;
        $item->{$config['field']} = $path;
        $item->save();

        \Log::info('✅ Modelo actualizado. Campo: ' . $config['field'] . ' = ' . $path);
        \Log::info('=== FIN uploadMain EXITOSO ===');

        return back()->with('success', "Imagen principal subida para: {$item->name}");
    } catch (\Exception $e) {
        \Log::error('EXCEPTION en uploadMain: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        return back()->with('error', 'Error al subir archivo: ' . $e->getMessage());
    }
}

    /**
     * Helper para mensajes de error de upload
     */
    private function getUploadErrorMessage($errorCode)
    {
        $errors = [
            UPLOAD_ERR_INI_SIZE => 'El archivo excede upload_max_filesize en php.ini',
            UPLOAD_ERR_FORM_SIZE => 'El archivo excede MAX_FILE_SIZE del formulario',
            UPLOAD_ERR_PARTIAL => 'El archivo fue subido parcialmente',
            UPLOAD_ERR_NO_FILE => 'No se subió ningún archivo',
            UPLOAD_ERR_NO_TMP_DIR => 'Falta el directorio temporal',
            UPLOAD_ERR_CANT_WRITE => 'No se pudo escribir el archivo en disco',
            UPLOAD_ERR_EXTENSION => 'Una extensión PHP detuvo la subida',
        ];
        return $errors[$errorCode] ?? 'Error desconocido';
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
