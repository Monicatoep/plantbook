<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;

class PlantController extends Controller
{
    public function index()
    {
        $plants = Plant::all();

        return inertia('plants/index', [
            'plants' => $plants,
        ]);
    }

    public function show(Plant $plant)
    {
        return inertia('plants/show', [
            'plant' => $plant,
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
        ]);

        Plant::create([
            'name' => $request->name,
        ]);

        return redirect()->route('plants.index')->with('success', 'Plant created successfully.');
    }
}
