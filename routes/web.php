<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
    Route::get('plants', [\App\Http\Controllers\PlantController::class, 'index'])->name('plants.index');
    Route::delete('plants/{plant}', [\App\Http\Controllers\PlantController::class, 'destroy'])->name('plants.destroy');
});

require __DIR__.'/settings.php';
