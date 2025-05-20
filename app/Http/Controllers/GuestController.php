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

        $selectedGroup = $request->group;
        $selectedStatus = $request->status;

       // Totales generales
        $yesCount = Guest::where('status', 'Sí')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);
        $noCount = Guest::where('status', 'No')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);
        $maybeCount = Guest::where('status', 'Tal vez')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);

        $childYes = Guest::where('status', 'Sí')->sum('child_companions');
        $childNo = Guest::where('status', 'No')->sum('child_companions');
        $childMaybe = Guest::where('status', 'Tal vez')->sum('child_companions');

        // Novio
        $novioYes = Guest::where('side', 'novio')->where('status', 'Sí')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);
        $novioNo = Guest::where('side', 'novio')->where('status', 'No')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);
        $novioMaybe = Guest::where('side', 'novio')->where('status', 'Tal vez')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);

        $novioChildYes = Guest::where('side', 'novio')->where('status', 'Sí')->sum('child_companions');
        $novioChildNo = Guest::where('side', 'novio')->where('status', 'No')->sum('child_companions');
        $novioChildMaybe = Guest::where('side', 'novio')->where('status', 'Tal vez')->sum('child_companions');

        // Novia
        $noviaYes = Guest::where('side', 'novia')->where('status', 'Sí')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);
        $noviaNo = Guest::where('side', 'novia')->where('status', 'No')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);
        $noviaMaybe = Guest::where('side', 'novia')->where('status', 'Tal vez')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);

        $noviaChildYes = Guest::where('side', 'novia')->where('status', 'Sí')->sum('child_companions');
        $noviaChildNo = Guest::where('side', 'novia')->where('status', 'No')->sum('child_companions');
        $noviaChildMaybe = Guest::where('side', 'novia')->where('status', 'Tal vez')->sum('child_companions');

        $novioAdultTotal = Guest::where('side', 'novio')->sum('adult_companions');
        $novioChildTotal = Guest::where('side', 'novio')->sum('child_companions');
        $novioPeopleTotal = Guest::where('side', 'novio')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);

        $noviaAdultTotal = Guest::where('side', 'novia')->sum('adult_companions');
        $noviaChildTotal = Guest::where('side', 'novia')->sum('child_companions');
        $noviaPeopleTotal = Guest::where('side', 'novia')->get()->sum(fn($g) => 1 + $g->adult_companions + $g->child_companions);

        return view('guests.index', compact(
            'guests',
            'selectedGroup',
            'selectedStatus',
            'yesCount',
            'noCount',
            'maybeCount',
            'childYes',
            'childNo',
            'childMaybe',
            'novioYes',
            'novioNo',
            'novioMaybe',
            'novioChildYes',
            'novioChildNo',
            'novioChildMaybe',
            'noviaYes',
            'noviaNo',
            'noviaMaybe',
            'noviaChildYes',
            'noviaChildNo',
            'noviaChildMaybe',
            'novioAdultTotal',
            'novioChildTotal',
            'novioPeopleTotal',
            'noviaAdultTotal',
            'noviaChildTotal',
            'noviaPeopleTotal',
        ));

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
            'side' => 'required|in:novio,novia',
            'child_companions' => 'integer|min:0',
            'adult_companions' => 'integer|min:0',
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
        'child_companions' => 'integer|min:0',
        'adult_companions' => 'integer|min:0',
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
