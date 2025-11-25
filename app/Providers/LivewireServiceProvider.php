<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Arr;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class LivewireServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Asegurar que el directorio existe
        $livewireTmpPath = storage_path('app/public/livewire-tmp');
        if (!file_exists($livewireTmpPath)) {
            mkdir($livewireTmpPath, 0775, true);
        }

        // Fix para Flysystem 3.x: el método put() retorna boolean, necesitamos que retorne el path
        // Sobrescribir el método storeAs() de TemporaryUploadedFile
        TemporaryUploadedFile::macro('storeAs', function ($path, $name = null, $options = []) {
            $options = $this->parseOptions($options);
            $disk = Arr::pull($options, 'disk') ?: $this->disk;
            $newPath = trim($path . '/' . $name, '/');

            // Usar putFileAs en lugar de put para obtener el path correcto
            $stream = $this->storage->readStream($this->path);
            $tempPath = tempnam(sys_get_temp_dir(), 'livewire_');
            file_put_contents($tempPath, stream_get_contents($stream));

            try {
                $uploadedFile = new \Illuminate\Http\UploadedFile(
                    $tempPath,
                    $name,
                    $this->getMimeType(),
                    null,
                    true
                );

                $result = Storage::disk($disk)->putFileAs(
                    dirname($newPath) === '.' ? '' : dirname($newPath),
                    $uploadedFile,
                    basename($newPath),
                    $options
                );

                // IMPORTANTE: Actualizar el path interno del objeto para que métodos como getSize() funcionen
                if ($result) {
                    $this->path = $result;
                    $this->disk = $disk;
                }

                return $result ?: $newPath;
            } finally {
                @unlink($tempPath);
            }
        });
    }
}
