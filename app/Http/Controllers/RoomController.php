<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index(Request $request)
    {
        $rooms = Room::withCount('plants')
            ->where('user_id', $request->user()->id)
            ->get();

        return inertia('rooms/index', [
            'rooms' => $rooms,
        ]);
    }

    public function show(Room $room)
    {
        return inertia('rooms/show', [
            'room' => $room->loadCount('plants'),
            'plants' => $room->plants()->with('species')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
        ]);

        Room::create([
            'name' => $request->name,
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('rooms.index');
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'name' => 'required|string|min:2|max:255',
        ]);

        $room->update(['name' => $request->name]);

        return redirect()->route('rooms.show', $room);
    }

    public function destroy(Room $room)
    {
        $room->delete();

        return redirect()->route('rooms.index');
    }
}
