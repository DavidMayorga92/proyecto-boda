@extends('layouts.app')

@section('content')
<h2>Agregar Invitado</h2>

<form action="{{ route('guests.store') }}" method="POST" class="mt-3">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Grupo</label>
        <input type="text" name="group" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Lado</label>
        <select name="side" class="form-select" required>
            <option value="novio" {{ old('side') == 'novio' ? 'selected' : '' }}>Novio</option>
            <option value="novia" {{ old('side') == 'novia' ? 'selected' : '' }}>Novia</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Acompañantes adultos</label>
        <input type="number" name="adult_companions" class="form-control" value="{{ old('adult_companions', $guest->adult_companions ?? 0) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Acompañantes niños</label>
        <input type="number" name="child_companions" class="form-control" value="{{ old('child_companions', $guest->child_companions ?? 0) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="status" class="form-select">
            <option value="Sí">Sí</option>
            <option value="No">No</option>
            <option value="Tal vez" selected>Tal vez</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Notas</label>
        <textarea name="notes" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
</form>
@endsection
