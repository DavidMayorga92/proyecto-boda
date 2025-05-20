@extends('layouts.app')

@section('content')
<h2 class="text-center">Confirmación de Asistencia</h2>

@if(session('success'))
    <div class="alert alert-success text-center mt-3">{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('guests.register') }}" class="mt-4 mx-auto" style="max-width: 500px;">
    @csrf

    <div class="mb-3">
        <label class="form-label">Nombre completo</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Grupo (familia, amigos...)</label>
        <input type="text" name="group" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Número de acompañantes</label>
        <input type="number" name="companions" class="form-control" value="0">
    </div>

    <div class="mb-3">
        <label class="form-label">¿Asistirás?</label>
        <select name="status" class="form-select" required>
            <option value="">-- Selecciona --</option>
            <option value="Sí">Sí 🎉</option>
            <option value="No">No 😔</option>
            <option value="Tal vez">Tal vez 🤔</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Notas (alergias, comentarios...)</label>
        <textarea name="notes" class="form-control"></textarea>
    </div>

    <button type="submit" class="btn btn-primary w-100">Enviar</button>
</form>
@endsection
