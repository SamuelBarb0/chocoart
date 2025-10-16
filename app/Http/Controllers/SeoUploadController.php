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
        $request->validate([
            'seo_id' => 'required|integer|exists:seo_settings,id',
            'file' => 'required|file|max:102400|mimes:jpg,jpeg,png,gif,webp',
        ]);

        $seoSetting = SeoSetting::findOrFail($request->seo_id);

        try {
            // Eliminar archivo anterior si existe
            if ($seoSetting->og_image && Storage::disk('public')->exists($seoSetting->og_image)) {
                Storage::disk('public')->delete($seoSetting->og_image);
            }

            // Subir nuevo archivo
            $file = $request->file('file');
            $filename = time() . '-' . str_replace(' ', '-', $file->getClientOriginalName());
            $path = $file->storeAs('seo/og', $filename, 'public');

            // Actualizar modelo
            $seoSetting->og_image = $path;
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
        $request->validate([
            'seo_id' => 'required|integer|exists:seo_settings,id',
        ]);

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
