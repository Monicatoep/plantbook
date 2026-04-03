<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function __invoke(Request $request)
    {
        $recentPlants = Plant::with('species')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->take(4)
            ->get();

        $plantCount = Plant::where('user_id', $request->user()->id)->count();

        return Inertia::render('home', [
            'recentPlants' => $recentPlants,
            'plantCount' => $plantCount,
        ]);
    }
}
