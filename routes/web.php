<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Models\Guest;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('guests', GuestController::class);

Route::get('/confirmar/{guest}', function (Guest $guest) {
    return view('guests.confirm', compact('guest'));
})->name('guests.confirm');

Route::post('/confirmar/{guest}', function (Request $request, Guest $guest) {
    $request->validate([
        'status' => 'required|in:Sí,No,Tal vez',
    ]);

    $guest->update(['status' => $request->status]);

    return redirect()->route('guests.confirm', $guest)->with('success', '¡Gracias por confirmar!');
});

Route::get('/registro', function () {
    return view('guests.register');
})->name('guests.register');

Route::post('/registro', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string',
        'group' => 'nullable|string',
        'companions' => 'integer|min:0',
        'status' => 'required|in:Sí,No,Tal vez',
        'notes' => 'nullable|string',
    ]);

    Guest::create($validated);

    return redirect()->route('guests.register')->with('success', 'Gracias por registrarte. ¡Nos vemos en la boda!');
});