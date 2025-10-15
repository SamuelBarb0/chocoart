<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class LogFileUpload
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Solo log en rutas de upload de Livewire/Filament
        if (str_contains($request->path(), 'livewire/upload-file')) {
            Log::info('=== UPLOAD ATTEMPT ===', [
                'url' => $request->fullUrl(),
                'method' => $request->method(),
                'has_files' => $request->hasFile('files'),
                'file_count' => count($request->allFiles()),
                'content_length' => $request->header('Content-Length'),
                'content_type' => $request->header('Content-Type'),
                'all_headers' => $request->headers->all(),
            ]);

            if ($request->hasFile('files')) {
                foreach ($request->file('files') as $key => $file) {
                    Log::info('File details', [
                        'key' => $key,
                        'original_name' => $file->getClientOriginalName(),
                        'mime_type' => $file->getMimeType(),
                        'size' => $file->getSize(),
                        'error' => $file->getError(),
                        'is_valid' => $file->isValid(),
                        'max_filesize_php' => ini_get('upload_max_filesize'),
                        'post_max_size_php' => ini_get('post_max_size'),
                        'temp_path' => $file->getRealPath(),
                    ]);
                }
            }
        }

        $response = $next($request);

        // Log response si es upload
        if (str_contains($request->path(), 'livewire/upload-file')) {
            Log::info('=== UPLOAD RESPONSE ===', [
                'status' => $response->getStatusCode(),
                'content' => $response->getContent(),
            ]);
        }

        return $response;
    }
}
