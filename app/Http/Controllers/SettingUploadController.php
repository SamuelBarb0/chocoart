<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingUploadController extends Controller
{
    /**
     * Mostrar formulario de upload de archivos para Settings
     */
    public function index()
    {
        // Solo settings de tipo 'image'
        $settings = Setting::where('type', 'image')
            ->orderBy('group')
            ->orderBy('order')
            ->get();

        return view('admin.settings-upload', compact('settings'));
    }

    /**
     * Procesar upload de archivo
     */
    public function upload(Request $request)
    {
        // Validación manual SIN usar Laravel validation
        if (!$request->has('setting_id')) {
            return back()->with('error', 'ID de setting no proporcionado');
        }

        if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
            return back()->with('error', 'No se subió ningún archivo o hubo un error');
        }

        $setting = Setting::findOrFail($request->setting_id);

        // Verificar que sea tipo imagen
        if ($setting->type !== 'image') {
            return back()->with('error', 'Este setting no es de tipo imagen');
        }

        try {
            // Obtener info del archivo desde $_FILES
            $uploadedFile = $_FILES['file'];
            $tmpName = $uploadedFile['tmp_name'];
            $originalName = basename($uploadedFile['name']);

            // Validación de extensión
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
            if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }

            // Crear directorio si no existe
            $directory = storage_path('app/public/settings');
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }

            // Crear nombre único y mover archivo
            $filename = time() . '-' . str_replace(' ', '-', $originalName);
            $destinationPath = $directory . '/' . $filename;

            if (!move_uploaded_file($tmpName, $destinationPath)) {
                return back()->with('error', 'Error al mover el archivo');
            }

            // Actualizar setting
            $setting->value = 'settings/' . $filename;
            $setting->save();

            return back()->with('success', "Archivo subido exitosamente para: {$setting->label}");
        } catch (\Exception $e) {
            return back()->with('error', 'Error al subir archivo: ' . $e->getMessage());
        }
    }

    /**
     * Eliminar archivo de un setting
     */
    public function delete(Request $request)
    {
        // Sin validación de Laravel
        if (!$request->has('setting_id')) {
            return back()->with('error', 'ID de setting no proporcionado');
        }

        $setting = Setting::findOrFail($request->setting_id);

        try {
            // Eliminar archivo
            if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }

            // Limpiar valor
            $setting->value = '';
            $setting->save();

            return back()->with('success', "Archivo eliminado de: {$setting->label}");
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar archivo: ' . $e->getMessage());
        }
    }
}
