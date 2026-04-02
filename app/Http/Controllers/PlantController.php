<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlantController extends Controller
{
    public function index()
    {
        $plants = Plant::all();

        return inertia('plants/index', [
            'plants' => $plants,
        ]);
    }

    public function create()
    {
        return inertia('plants/create');
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
            'description' => 'nullable|string|max:1000',
            'last_watered_at' => 'nullable|date',
            'image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only('name', 'description', 'last_watered_at');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('plants', 'public');
            $data['image'] = Storage::disk('public')->url($path);
        }

        Plant::create($data);

        return redirect()->route('plants.index')->with('success', 'Plant created successfully.');
    }
}
