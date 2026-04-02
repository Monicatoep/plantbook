<?php

namespace App\Http\Controllers;

use App\Models\PlantSpecies;

class PlantSpeciesController extends Controller
{
    public function index()
    {
        $species = PlantSpecies::paginate(30);

        return inertia('species/index', [
            'species' => $species,
        ]);
    }

    public function show(PlantSpecies $plantSpecies)
    {
        return inertia('species/show', [
            'species' => $plantSpecies,
        ]);
    }
}
