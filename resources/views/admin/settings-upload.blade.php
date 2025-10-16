<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Archivos - Configuración Chocoart</title>
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
                            🍫 Subir Archivos - Configuración
                        </h1>
                        <p class="text-gray-600 mt-2">Sube imágenes y videos para las configuraciones del sitio</p>
                    </div>
                    <a href="/admin/settings"
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

            <!-- Grid de settings agrupados -->
            @php
                $grouped = $settings->groupBy('group');
                $groupNames = [
                    'home' => 'Inicio',
                    'contact' => 'Contacto',
                    'social' => 'Redes Sociales',
                    'footer' => 'Footer',
                    'general' => 'General',
                ];
                $groupColors = [
                    'home' => 'var(--rosa)',
                    'contact' => 'var(--menta)',
                    'social' => 'var(--pistacho)',
                    'footer' => 'var(--choco)',
                    'general' => '#6b7280',
                ];
            @endphp

            @foreach($grouped as $group => $groupSettings)
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-4 pb-2 border-b-2"
                        style="color: {{ $groupColors[$group] ?? '#6b7280' }}; border-color: {{ $groupColors[$group] ?? '#6b7280' }}">
                        {{ $groupNames[$group] ?? $group }}
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($groupSettings as $setting)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow duration-300">
                                <div class="flex items-start justify-between mb-3">
                                    <div class="flex-1">
                                        <h3 class="font-bold text-lg" style="color: var(--choco)">
                                            {{ $setting->label }}
                                        </h3>
                                        @if($setting->description)
                                            <p class="text-sm text-gray-600 mt-1">{{ $setting->description }}</p>
                                        @endif
                                        <p class="text-xs text-gray-400 mt-1 font-mono">{{ $setting->key }}</p>
                                    </div>
                                </div>

                                <!-- Preview de archivo actual -->
                                @if($setting->value)
                                    <div class="mb-3 p-3 bg-gray-50 rounded-lg">
                                        <p class="text-xs font-semibold text-gray-700 mb-2">Archivo actual:</p>
                                        @php
                                            $ext = strtolower(pathinfo($setting->value, PATHINFO_EXTENSION));
                                            $isVideo = in_array($ext, ['mp4', 'webm', 'mov']);
                                        @endphp

                                        @if($isVideo)
                                            <video src="{{ asset('storage/' . $setting->value) }}"
                                                   class="w-full h-32 object-cover rounded-lg mb-2"
                                                   controls>
                                            </video>
                                        @else
                                            <img src="{{ asset('storage/' . $setting->value) }}"
                                                 alt="{{ $setting->label }}"
                                                 class="w-full h-32 object-cover rounded-lg mb-2"
                                                 onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect width=%22100%22 height=%22100%22 fill=%22%23ddd%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 fill=%22%23999%22%3ENo disponible%3C/text%3E%3C/svg%3E'">
                                        @endif

                                        <p class="text-xs text-gray-600 truncate mb-2">{{ basename($setting->value) }}</p>

                                        <!-- Botón de eliminar -->
                                        <form action="{{ route('settings.upload.delete') }}"
                                              method="POST"
                                              onsubmit="return confirm('¿Eliminar este archivo?')"
                                              class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="setting_id" value="{{ $setting->id }}">
                                            <button type="submit"
                                                    class="text-xs px-3 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition-colors">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </div>
                                @else
                                    <div class="mb-3 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                        <p class="text-xs text-yellow-700">⚠️ Sin archivo</p>
                                    </div>
                                @endif

                                <!-- Formulario de upload -->
                                <form action="{{ route('settings.upload.store') }}"
                                      method="POST"
                                      enctype="multipart/form-data"
                                      class="space-y-3">
                                    @csrf
                                    <input type="hidden" name="setting_id" value="{{ $setting->id }}">

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Nuevo archivo (máx 100MB)
                                        </label>
                                        <input type="file"
                                               name="file"
                                               accept="image/*,video/*"
                                               class="w-full text-sm border border-gray-300 rounded-lg p-2
                                                      file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                                      file:text-sm file:font-semibold file:text-white
                                                      hover:file:opacity-90 file:cursor-pointer"
                                               style="file:background-color: {{ $groupColors[$group] ?? '#6b7280' }}"
                                               required>
                                    </div>

                                    <button type="submit"
                                            class="w-full py-2 px-4 rounded-lg text-white font-semibold
                                                   transition-all duration-300 hover:shadow-lg"
                                            style="background-color: {{ $groupColors[$group] ?? '#6b7280' }}"
                                            onmouseover="this.style.opacity='0.8'"
                                            onmouseout="this.style.opacity='1'">
                                        📤 Subir archivo
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            @if($settings->isEmpty())
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <p class="text-gray-500 text-lg">No hay configuraciones de tipo "imagen" disponibles.</p>
                    <p class="text-gray-400 text-sm mt-2">Crea configuraciones con tipo "Imagen" desde Filament primero.</p>
                </div>
            @endif
        </div>
    </div>
</body>
</html>
