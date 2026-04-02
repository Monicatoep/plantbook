<?php

use App\Http\Controllers\PlantController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::inertia('dashboard', 'dashboard')->name('dashboard');
    Route::get('plants', [PlantController::class, 'index'])->name('plants.index');
    Route::get('plants/{plant}', [PlantController::class, 'show'])->name('plants.show');
    Route::delete('plants/{plant}', [PlantController::class, 'destroy'])->name('plants.destroy');
    Route::post('plants', [PlantController::class, 'store'])->name('plants.store');
});

require __DIR__.'/settings.php';
