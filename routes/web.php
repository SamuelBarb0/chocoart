<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Course;
use App\Models\Post;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\SettingUploadController;
use App\Http\Controllers\SeoUploadController;

// Home page
Route::get('/', function () {
    $productos = Product::with('category')->where('published', true)->orderBy('order')->get();
    return view('home', compact('productos'));
})->name('home');

// Productos
Route::get('/productos', function () {
    $productos = Product::with('category')->where('published', true)->orderBy('order')->get();
    return view('productos', compact('productos'));
})->name('productos');

// Cursos
Route::get('/cursos', function () {
    $cursos = Course::with('category')->where('published', true)->orderBy('order')->get();
    return view('cursos', compact('cursos'));
})->name('cursos');

// Galería
Route::get('/galeria', function () {
    $images = GalleryImage::with('category')
        ->orderByDesc('featured')
        ->orderBy('order')
        ->orderBy('id')
        ->get();

    // Obtener solo categorías que tienen imágenes asignadas
    $categories = \App\Models\Category::where('type', 'gallery')
        ->where('active', true)
        ->whereHas('galleryImages') // Solo categorías con imágenes
        ->orderBy('order')
        ->get()
        ->map(fn ($cat) => [
            'label' => $cat->name,
            'slug'  => $cat->slug,
        ]);

    return view('galeria', compact('images', 'categories'));
})->name('galeria');

// Blog
Route::get('/blog', function () {
    $posts = Post::with('category')->where('published', true)->orderBy('published_at', 'desc')->get();
    return view('blog', compact('posts'));
})->name('blog');

// Blog Post Individual
Route::get('/blog/{slug}', function ($slug) {
    $post = Post::with('category')->where('slug', $slug)->where('published', true)->firstOrFail();

    // Obtener posts relacionados (misma categoría o los más recientes)
    $relatedPosts = Post::with('category')
        ->where('published', true)
        ->where('id', '!=', $post->id)
        ->where('category_id', $post->category_id)
        ->orderBy('published_at', 'desc')
        ->take(3)
        ->get();

    // Si no hay suficientes de la misma categoría, llenar con otros posts recientes
    if ($relatedPosts->count() < 3) {
        $additionalPosts = Post::with('category')
            ->where('published', true)
            ->where('id', '!=', $post->id)
            ->whereNotIn('id', $relatedPosts->pluck('id'))
            ->orderBy('published_at', 'desc')
            ->take(3 - $relatedPosts->count())
            ->get();
        $relatedPosts = $relatedPosts->merge($additionalPosts);
    }

    return view('blog-post', compact('post', 'relatedPosts'));
})->name('blog.post');

// Contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Contact form submission
Route::post('/contacto', function () {
    // TODO: Process contact form
    return redirect()->back()->with('success', 'Mensaje enviado correctamente');
})->name('contacto.store');

// Admin: Subir archivos para Settings
Route::middleware(['web'])->group(function () {
    Route::get('/admin/settings-upload', [SettingUploadController::class, 'index'])->name('settings.upload.index');
    Route::post('/admin/settings-upload', [SettingUploadController::class, 'upload'])->name('settings.upload.store');
    Route::delete('/admin/settings-upload', [SettingUploadController::class, 'delete'])->name('settings.upload.delete');
});

// Admin: Subir imágenes OG para SEO
Route::middleware(['web'])->group(function () {
    Route::get('/admin/seo-upload', [SeoUploadController::class, 'index'])->name('seo.upload.index');
    Route::post('/admin/seo-upload', [SeoUploadController::class, 'upload'])->name('seo.upload.store');
    Route::delete('/admin/seo-upload', [SeoUploadController::class, 'delete'])->name('seo.upload.delete');
});

Route::get('/media/{path}', function (string $path) {
    $path = str_replace('..', '', $path);
    abort_unless(Storage::disk('public_uploads')->exists($path), 404);
    return response()->file(Storage::disk('public_uploads')->path($path));
})->where('path', '.*');
