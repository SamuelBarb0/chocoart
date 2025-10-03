<?php

use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('home');
})->name('home');

// Contact form submission (optional - you can create a controller later)
Route::post('/contacto', function () {
    // TODO: Process contact form
    return redirect()->back()->with('success', 'Mensaje enviado correctamente');
})->name('contacto.store');
