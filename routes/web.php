<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PlantSpeciesController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;

Route::inertia('/', 'welcome', [
    'canRegister' => Features::enabled(Features::registration()),
])->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('home', HomeController::class)->name('home');
    Route::get('species', [PlantSpeciesController::class, 'index'])->name('species.index');
    Route::get('species/{plantSpecies}', [PlantSpeciesController::class, 'show'])->name('species.show');

    Route::get('plants', [PlantController::class, 'index'])->name('plants.index');
    Route::get('plants/{plant}', [PlantController::class, 'show'])->name('plants.show');
    Route::delete('plants/{plant}', [PlantController::class, 'destroy'])->name('plants.destroy');
    Route::post('plants', [PlantController::class, 'store'])->name('plants.store');

    Route::get('rooms', [RoomController::class, 'index'])->name('rooms.index');
    Route::get('rooms/{room}', [RoomController::class, 'show'])->name('rooms.show');
    Route::post('rooms', [RoomController::class, 'store'])->name('rooms.store');
    Route::put('rooms/{room}', [RoomController::class, 'update'])->name('rooms.update');
    Route::delete('rooms/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
});

require __DIR__.'/settings.php';
