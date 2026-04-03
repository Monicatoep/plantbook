<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\PlantSpecies;
use Illuminate\Http\Request;

class PlantSpeciesController extends Controller
{
    public function index(Request $request)
    {
        $species = PlantSpecies::query()
            ->when($request->search, function ($query, $search) {
                $query->where('common_name', 'like', "%{$search}%")
                    ->orWhere('family', 'like', "%{$search}%")
                    ->orWhere('scientific_name', 'like', "%{$search}%");
            })
            ->paginate(30)
            ->withQueryString();

        return inertia('species/index', [
            'species' => $species,
            'filters' => [
                'search' => $request->search ?? '',
            ],
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
