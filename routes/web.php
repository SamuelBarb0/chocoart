<?php

use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Course;
use App\Models\Post;
use App\Models\GalleryImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\SettingUploadController;
use App\Http\Controllers\AdminUploadController;

// Home page
Route::get('/', function () {
    $productos = Product::where('published', true)->orderBy('order')->get();
    return view('home', compact('productos'));
})->name('home');

// Productos
Route::get('/productos', function () {
    $productos = Product::where('published', true)->orderBy('order')->get();
    return view('productos', compact('productos'));
})->name('productos');

// Cursos
Route::get('/cursos', function () {
    $cursos = Course::where('published', true)->orderBy('order')->get();
    return view('cursos', compact('cursos'));
})->name('cursos');

// Galería
Route::get('/galeria', function () {
    $images = GalleryImage::query()
        ->orderByDesc('featured')
        ->orderBy('order')
        ->orderBy('id')
        ->get();

    $categories = $images->pluck('category')
        ->filter()
        ->unique()
        ->values()
        ->map(fn ($c) => [
            'label' => $c,
            'slug'  => Str::of($c)->lower()->slug('-'),
        ]);

    return view('galeria', compact('images', 'categories'));
})->name('galeria');

// Blog
Route::get('/blog', function () {
    $posts = Post::where('published', true)->orderBy('published_at', 'desc')->get();
    return view('blog', compact('posts'));
})->name('blog');

// Blog Post Individual
Route::get('/blog/{slug}', function ($slug) {
    $post = Post::where('slug', $slug)->where('published', true)->firstOrFail();

    // Obtener posts relacionados (misma categoría o los más recientes)
    $relatedPosts = Post::where('published', true)
        ->where('id', '!=', $post->id)
        ->where('category', $post->category)
        ->orderBy('published_at', 'desc')
        ->take(3)
        ->get();

    // Si no hay suficientes de la misma categoría, llenar con otros posts recientes
    if ($relatedPosts->count() < 3) {
        $additionalPosts = Post::where('published', true)
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

// Admin: Subir archivos para Products, Courses, Posts, Gallery
Route::middleware(['web'])->group(function () {
    Route::get('/admin/uploads', [AdminUploadController::class, 'index'])->name('admin.uploads.index');
    Route::post('/admin/uploads/main', [AdminUploadController::class, 'uploadMain'])->name('admin.uploads.main');
    Route::post('/admin/uploads/gallery', [AdminUploadController::class, 'uploadGallery'])->name('admin.uploads.gallery');
    Route::delete('/admin/uploads/gallery', [AdminUploadController::class, 'deleteGalleryImage'])->name('admin.uploads.gallery.delete');
});

Route::get('/media/{path}', function (string $path) {
    $path = str_replace('..', '', $path);
    abort_unless(Storage::disk('public_uploads')->exists($path), 404);
    return response()->file(Storage::disk('public_uploads')->path($path));
})->where('path', '.*');
