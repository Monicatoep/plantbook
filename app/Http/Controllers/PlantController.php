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

    public function destroy(Plant $plant)
    {
        $plant->delete();
        return redirect()->route('plants.index')->with('success', 'Plant deleted successfully.');
    }
}
