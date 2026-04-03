<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index(Request $request)
    {
        $plants = Plant::with('species')->where('user_id', $request->user()->id)->get();

        return inertia('plants/index', [
            'plants' => $plants,
        ]);
    }

    public function show(Plant $plant)
    {
        return inertia('plants/show', [
            'plant' => $plant->load('species'),
        ]);
    }

    public function destroy(Plant $plant)
    {
        $plant->delete();

        return redirect()->route('plants.index')->with('success', 'Plant deleted successfully.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'description' => 'nullable|string|max:1000',
            'plant_species_id' => 'nullable|exists:plant_species,id',
        ]);

        $data = $request->only('name', 'description', 'plant_species_id');
        $data['user_id'] = $request->user()->id;

        Plant::create($data);

        return redirect()->route('plants.index')->with('success', 'Plant created successfully.');
    }
}
