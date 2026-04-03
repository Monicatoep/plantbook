<?php

namespace App\Http\Controllers;

use App\Models\PlantSpecies;
use Illuminate\Http\Request;

class PlantSpeciesController extends Controller
{
    public function index()
    {
        $species = PlantSpecies::paginate(30);

        return inertia('species/index', [
            'species' => $species,
        ]);
    }

    public function show(Request $request, PlantSpecies $plantSpecies)
    {
        $alreadyAdded = Plant::where('user_id', $request->user()->id)
            ->where('plant_species_id', $plantSpecies->id)
            ->exists();

        return inertia('species/show', [
            'species' => $plantSpecies,
            'alreadyAdded' => $alreadyAdded,
        ]);
    }
}
