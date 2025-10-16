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
        $request->validate([
            'setting_id' => 'required|exists:settings,id',
            'file' => 'required|file|max:102400|mimes:jpg,jpeg,png,gif,webp,mp4,webm,mov',
        ]);

        $setting = Setting::findOrFail($request->setting_id);

        // Verificar que sea tipo imagen
        if ($setting->type !== 'image') {
            return back()->with('error', 'Este setting no es de tipo imagen');
        }

        try {
            // Eliminar archivo anterior si existe
            if ($setting->value && Storage::disk('public')->exists($setting->value)) {
                Storage::disk('public')->delete($setting->value);
            }

            // Subir nuevo archivo
            $file = $request->file('file');
            $filename = time() . '-' . str_replace(' ', '-', $file->getClientOriginalName());
            $path = $file->storeAs('settings', $filename, 'public');

            // Actualizar setting
            $setting->value = $path;
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
        $request->validate([
            'setting_id' => 'required|exists:settings,id',
        ]);

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
