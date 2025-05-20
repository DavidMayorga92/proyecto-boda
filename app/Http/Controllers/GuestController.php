<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Guest::query();

        if ($request->filled('group')) {
            $query->where('group', $request->group);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $guests = $query->get();

        // Para mostrar los valores actuales en el formulario
        $selectedGroup = $request->group;
        $selectedStatus = $request->status;

        $yesCount = Guest::where('status', 'Sí')->count();
        $noCount = Guest::where('status', 'No')->count();
        $maybeCount = Guest::where('status', 'Tal vez')->count();

        return view('guests.index', compact('guests', 'selectedGroup', 'selectedStatus', 'yesCount', 'noCount', 'maybeCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'group' => 'nullable|string',
            'companions' => 'integer|min:0',
            'status' => 'in:Sí,No,Tal vez',
            'notes' => 'nullable|string',
        ]);

        Guest::create($validated);

        return redirect()->route('guests.index')->with('success', 'Invitado agregado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        return view('guests.edit', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Guest $guest)
    {
        $validated = $request->validate([
        'name' => 'required|string',
        'group' => 'nullable|string',
        'companions' => 'integer|min:0',
        'status' => 'in:Sí,No,Tal vez',
        'notes' => 'nullable|string',
        ]);

        $guest->update($validated);

        return redirect()->route('guests.index')->with('success', 'Invitado actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        $guest->delete();

        return redirect()->route('guests.index')->with('success', 'Invitado eliminado.');
    }
}
