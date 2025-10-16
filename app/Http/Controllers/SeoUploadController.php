<?php

namespace App\Http\Controllers;

use App\Models\SeoSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeoUploadController extends Controller
{
    /**
     * Mostrar formulario de upload para SEO Open Graph images
     */
    public function index()
    {
        // Obtener todas las configuraciones SEO existentes
        $seoSettings = SeoSetting::query()
            ->orderBy('page', 'asc')
            ->get();

        // Páginas permitidas (para crear nuevas si no existen)
        $allowedPages = [
            'home' => 'Inicio',
            'productos' => 'Productos',
            'cursos' => 'Cursos',
            'galeria' => 'Galería',
            'blog' => 'Blog',
            'contacto' => 'Contacto',
        ];

        return view('admin.seo-upload', [
            'seoSettings' => $seoSettings,
            'allowedPages' => $allowedPages,
        ]);
    }

    /**
     * Procesar upload de imagen OG
     */
    public function upload(Request $request)
    {
        // Validación manual SIN usar Laravel validation
        if (!$request->has('seo_id')) {
            return back()->with('error', 'ID de SEO setting no proporcionado');
        }

        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            return back()->with('error', 'No se subió ningún archivo o hubo un error');
        }

        $seoSetting = SeoSetting::findOrFail($request->seo_id);

        try {
            // Obtener info del archivo desde $_FILES
            $uploadedFile = $_FILES['file'];
            $tmpName = $uploadedFile['tmp_name'];
            $originalName = basename($uploadedFile['name']);

            // Validación de extensión
            $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
            $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (!in_array($ext, $allowedExts)) {
                return back()->with('error', 'Tipo de archivo no permitido');
            }

            // Validación de tamaño (100MB)
            if ($uploadedFile['size'] > 104857600) {
                return back()->with('error', 'Archivo demasiado grande (máx 100MB)');
            }

            // Eliminar archivo anterior si existe
            if ($seoSetting->og_image && Storage::disk('public')->exists($seoSetting->og_image)) {
                Storage::disk('public')->delete($seoSetting->og_image);
            }

            // Crear directorio si no existe
            $directory = storage_path('app/public/seo/og');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Crear nombre único y mover archivo
            $filename = time() . '-' . str_replace(' ', '-', $originalName);
            $destinationPath = $directory . '/' . $filename;

            if (!move_uploaded_file($tmpName, $destinationPath)) {
                return back()->with('error', 'Error al mover el archivo');
            }

            // Actualizar modelo
            $seoSetting->og_image = 'seo/og/' . $filename;
            $seoSetting->save();

            return back()->with('success', "Imagen OG subida para: {$seoSetting->page}");
        } catch (\Exception $e) {
            return back()->with('error', 'Error al subir archivo: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar imagen OG
     */
    public function delete(Request $request)
    {
        // Sin validación de Laravel
        if (!$request->has('seo_id')) {
            return back()->with('error', 'ID de SEO setting no proporcionado');
        }

        $seoSetting = SeoSetting::findOrFail($request->seo_id);

        try {
            if ($seoSetting->og_image) {
                // Eliminar archivo físico
                if (Storage::disk('public')->exists($seoSetting->og_image)) {
                    Storage::disk('public')->delete($seoSetting->og_image);
                }

                // Limpiar campo
                $seoSetting->og_image = null;
                $seoSetting->save();

                return back()->with('success', "Imagen OG eliminada para: {$seoSetting->page}");
            }

            return back()->with('info', 'No hay imagen para eliminar');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar archivo: ' . $e->getMessage());
        }
    }
}
