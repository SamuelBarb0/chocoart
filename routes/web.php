<?php

use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('home');
})->name('home');

// Productos
Route::get('/productos', function () {
    return view('productos');
})->name('productos');

// Cursos
Route::get('/cursos', function () {
    return view('cursos');
})->name('cursos');

// Galería
Route::get('/galeria', function () {
    return view('galeria');
})->name('galeria');

// Contacto
Route::get('/contacto', function () {
    return view('contacto');
})->name('contacto');

// Contact form submission
Route::post('/contacto', function () {
    // TODO: Process contact form
    return redirect()->back()->with('success', 'Mensaje enviado correctamente');
})->name('contacto.store');
