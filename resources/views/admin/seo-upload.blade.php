<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imágenes OG - SEO Chocoart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --rosa: #e28dc4;
            --menta: #81cacf;
            --pistacho: #c6d379;
            --choco: #5f3917;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold" style="color: var(--choco)">
                            🖼️ Subir Imágenes Open Graph - SEO
                        </h1>
                        <p class="text-gray-600 mt-2">Imágenes para redes sociales (recomendado: 1200×630px)</p>
                    </div>
                    <a href="/admin/seo-settings"
                       class="px-4 py-2 rounded-lg text-white transition-colors duration-300"
                       style="background-color: var(--rosa)"
                       onmouseover="this.style.backgroundColor='var(--menta)'"
                       onmouseout="this.style.backgroundColor='var(--rosa)'">
                        ← Volver a Filament
                    </a>
                </div>
            </div>

            <!-- Mensajes de éxito/error -->
            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-lg">
                    <p class="font-bold">✅ Éxito</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                    <p class="font-bold">❌ Error</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if(session('info'))
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4 mb-6 rounded-lg">
                    <p class="font-bold">ℹ️ Info</p>
                    <p>{{ session('info') }}</p>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-lg">
                    <p class="font-bold">❌ Errores de validación</p>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Info Box -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-blue-800">
                    <strong>💡 Tip:</strong> Las imágenes Open Graph se muestran cuando compartes enlaces de tu sitio en redes sociales (Facebook, Twitter, LinkedIn, WhatsApp).
                    El tamaño recomendado es 1200×630 píxeles.
                </p>
            </div>

            <!-- Grid de páginas SEO -->
            @php
                $pageColors = [
                    'home' => 'var(--rosa)',
                    'productos' => 'var(--menta)',
                    'cursos' => 'var(--pistacho)',
                    'galeria' => 'var(--choco)',
                    'blog' => '#f59e0b',
                    'contacto' => '#8b5cf6',
                ];
            @endphp

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($seoSettings as $seo)
                    <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="px-3 py-1 rounded-full text-white text-sm font-semibold"
                                          style="background-color: {{ $pageColors[$seo->page] ?? '#6b7280' }}">
                                        {{ $allowedPages[$seo->page] ?? $seo->page }}
                                    </span>
                                </div>
                                <h3 class="font-bold text-lg" style="color: var(--choco)">
                                    {{ $seo->meta_title }}
                                </h3>
                                @if($seo->og_title && $seo->og_title !== $seo->meta_title)
                                    <p class="text-sm text-gray-600 mt-1">OG: {{ $seo->og_title }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Preview de imagen OG actual -->
                        @if($seo->og_image)
                            <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                                <p class="text-xs font-semibold text-gray-700 mb-2">Imagen OG actual:</p>
                                <img src="{{ asset('storage/' . $seo->og_image) }}"
                                     alt="OG Image {{ $seo->page }}"
                                     class="w-full h-40 object-cover rounded-lg mb-2"
                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect width=%22100%22 height=%22100%22 fill=%22%23ddd%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 fill=%22%23999%22%3ENo disponible%3C/text%3E%3C/svg%3E'">
                                <p class="text-xs text-gray-600 truncate mb-2">{{ basename($seo->og_image) }}</p>

                                <!-- Botón de eliminar -->
                                <form action="{{ route('seo.upload.delete') }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar esta imagen OG?')"
                                      class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="seo_id" value="{{ $seo->id }}">
                                    <button type="submit"
                                            class="text-xs px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                                        🗑️ Eliminar
                                    </button>
                                </form>
                            </div>
                        @else
                            <div class="mb-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                <p class="text-xs text-yellow-700">⚠️ Sin imagen OG</p>
                            </div>
                        @endif

                        <!-- Formulario de upload -->
                        <form action="{{ route('seo.upload.store') }}"
                              method="POST"
                              enctype="multipart/form-data"
                              class="space-y-3">
                            @csrf
                            <input type="hidden" name="seo_id" value="{{ $seo->id }}">

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Nueva imagen OG (máx 100MB)
                                </label>
                                <input type="file"
                                       name="file"
                                       accept="image/jpeg,image/png,image/gif,image/webp"
                                       class="w-full text-sm border border-gray-300 rounded-lg p-2
                                              file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                              file:text-sm file:font-semibold file:text-white
                                              hover:file:opacity-90 file:cursor-pointer"
                                       style="file:background-color: {{ $pageColors[$seo->page] ?? '#6b7280' }}"
                                       required>
                            </div>

                            <button type="submit"
                                    class="w-full py-2 px-4 rounded-lg text-white font-semibold
                                           transition-all duration-300 hover:shadow-lg"
                                    style="background-color: {{ $pageColors[$seo->page] ?? '#6b7280' }}"
                                    onmouseover="this.style.opacity='0.8'"
                                    onmouseout="this.style.opacity='1'">
                                📤 Subir imagen OG
                            </button>
                        </form>
                    </div> 
                @empty
                    <div class="col-span-2 bg-white rounded-lg shadow-md p-12 text-center">
                        <p class="text-gray-500 text-lg">No hay configuraciones SEO disponibles.</p>
                        <p class="text-gray-400 text-sm mt-2">Crea configuraciones SEO desde Filament primero.</p>
                        <a href="/admin/seo-settings/create"
                           class="inline-block mt-4 px-6 py-2 rounded-lg text-white"
                           style="background-color: var(--rosa)">
                            ➕ Crear configuración SEO
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Footer Info -->
            <div class="mt-8 bg-white rounded-lg shadow-md p-6">
                <h3 class="font-bold text-lg mb-3" style="color: var(--choco)">📚 Guía de uso</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    <li><strong>1.</strong> Selecciona la página que quieres configurar</li>
                    <li><strong>2.</strong> Sube una imagen de 1200×630 píxeles (recomendado)</li>
                    <li><strong>3.</strong> La imagen se mostrará automáticamente cuando compartas enlaces en redes sociales</li>
                    <li><strong>4.</strong> Puedes eliminar la imagen actual si quieres cambiarla</li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
