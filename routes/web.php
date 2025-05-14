<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::get('dashboard', function() {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

// Ruta para el componente de departamentos
Route::get('departamentos', function () {
    return view('departamentos');
})->middleware(['auth'])->name('departamentos');

require __DIR__.'/auth.php';