<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subir Imágenes - {{ $config['title'] }} - Chocoart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Header -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <div class="flex items-center justify-between flex-wrap gap-4">
                    <div>
                        <h1 class="text-3xl font-bold" style="color: {{ $config['color'] }}">
                            🍫 Subir Imágenes - {{ $config['title'] }}
                        </h1>
                        <p class="text-gray-600 mt-2">Gestiona las imágenes de tus {{ strtolower($config['title']) }}</p>
                    </div>
                    <div class="flex gap-3">
                        <!-- Selector de recursos -->
                        <select onchange="window.location.href='/admin/uploads?resource='+this.value"
                                class="px-4 py-2 border border-gray-300 rounded-lg">
                            <option value="products" {{ $resource === 'products' ? 'selected' : '' }}>Productos</option>
                            <option value="courses" {{ $resource === 'courses' ? 'selected' : '' }}>Cursos</option>
                            <option value="posts" {{ $resource === 'posts' ? 'selected' : '' }}>Blog Posts</option>
                            <option value="gallery" {{ $resource === 'gallery' ? 'selected' : '' }}>Galería</option>
                        </select>

                        <a href="/admin/{{ $resource }}"
                           class="px-4 py-2 rounded-lg text-white transition-colors duration-300"
                           style="background-color: {{ $config['color'] }}"
                           onmouseover="this.style.opacity='0.8'"
                           onmouseout="this.style.opacity='1'">
                            ← Volver a Filament
                        </a>
                    </div>
                </div>
            </div>

            <!-- Mensajes -->
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
                    <p class="font-bold">❌ Errores</p>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Items -->
            @forelse($items as $item)
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-2xl font-bold mb-4" style="color: {{ $config['color'] }}">
                        {{ $item->name ?? $item->title ?? 'Item #' . $item->id }}
                    </h2>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <!-- Imagen Principal -->
                        <div class="border border-gray-200 rounded-lg p-4">
                            <h3 class="font-bold text-lg mb-3">📸 Imagen Principal</h3>

                            @if($item->{$config['field']})
                                <img src="{{ asset('storage/' . $item->{$config['field']}) }}"
                                     alt="{{ $item->name }}"
                                     class="w-full h-48 object-cover rounded-lg mb-3"
                                     onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22%3E%3Crect width=%22200%22 height=%22200%22 fill=%22%23ddd%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 fill=%22%23999%22 font-size=%2216%22%3ENo disponible%3C/text%3E%3C/svg%3E'">
                                <p class="text-xs text-gray-600 mb-3">{{ basename($item->{$config['field']}) }}</p>
                            @else
                                <div class="w-full h-48 bg-gray-100 rounded-lg flex items-center justify-center mb-3">
                                    <p class="text-gray-400">Sin imagen</p>
                                </div>
                            @endif

                            <form action="{{ route('admin.uploads.main') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="resource" value="{{ $resource }}">
                                <input type="hidden" name="item_id" value="{{ $item->id }}">

                                <input type="file" name="file" accept="image/*,video/*" required
                                       class="w-full text-sm border border-gray-300 rounded-lg p-2 mb-3
                                              file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                              file:text-sm file:font-semibold file:text-white file:cursor-pointer"
                                       style="file:background-color: {{ $config['color'] }}">

                                <button type="submit"
                                        class="w-full py-2 px-4 rounded-lg text-white font-semibold transition-opacity"
                                        style="background-color: {{ $config['color'] }}"
                                        onmouseover="this.style.opacity='0.8'"
                                        onmouseout="this.style.opacity='1'">
                                    📤 Subir Imagen Principal
                                </button>
                            </form>
                        </div>

                        <!-- Galería (si tiene) -->
                        @if($config['has_gallery'])
                            <div class="border border-gray-200 rounded-lg p-4">
                                <h3 class="font-bold text-lg mb-3">🖼️ Galería ({{ count($item->images ?? []) }} imágenes)</h3>

                                @if(!empty($item->images))
                                    <div class="grid grid-cols-3 gap-2 mb-3 max-h-48 overflow-y-auto">
                                        @foreach($item->images as $imagePath)
                                            <div class="relative group">
                                                <img src="{{ asset('storage/' . $imagePath) }}"
                                                     alt="Galería"
                                                     class="w-full h-20 object-cover rounded">
                                                <form action="{{ route('admin.uploads.gallery.delete') }}"
                                                      method="POST"
                                                      onsubmit="return confirm('¿Eliminar esta imagen?')"
                                                      class="absolute top-1 right-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" name="resource" value="{{ $resource }}">
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="image_path" value="{{ $imagePath }}">
                                                    <button type="submit"
                                                            class="bg-red-500 text-white rounded-full w-6 h-6 text-xs hover:bg-red-600">
                                                        ✕
                                                    </button>
                                                </form>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-gray-400 text-sm mb-3">Sin imágenes en galería</p>
                                @endif

                                <form action="{{ route('admin.uploads.gallery') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="resource" value="{{ $resource }}">
                                    <input type="hidden" name="item_id" value="{{ $item->id }}">

                                    <input type="file" name="files[]" accept="image/*" multiple required
                                           class="w-full text-sm border border-gray-300 rounded-lg p-2 mb-3
                                                  file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0
                                                  file:text-sm file:font-semibold file:text-white file:cursor-pointer"
                                           style="file:background-color: {{ $config['color'] }}">

                                    <button type="submit"
                                            class="w-full py-2 px-4 rounded-lg text-white font-semibold transition-opacity"
                                            style="background-color: {{ $config['color'] }}"
                                            onmouseover="this.style.opacity='0.8'"
                                            onmouseout="this.style.opacity='1'">
                                        📤 Agregar a Galería
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-lg shadow-md p-12 text-center">
                    <p class="text-gray-500 text-lg">No hay {{ strtolower($config['title']) }} disponibles.</p>
                    <p class="text-gray-400 text-sm mt-2">Crea items desde Filament primero.</p>
                </div>
            @endforelse
        </div>
    </div>
</body>
</html>
