@extends('layouts.app')

@section('content')
<h2>Editar Invitado</h2>

<form action="{{ route('guests.update', $guest) }}" method="POST" class="mt-3">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" name="name" class="form-control" value="{{ $guest->name }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Grupo</label>
        <input type="text" name="group" class="form-control" value="{{ $guest->group }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Acompañantes</label>
        <input type="number" name="companions" class="form-control" value="{{ $guest->companions }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="status" class="form-select">
            <option value="Sí" {{ $guest->status == 'Sí' ? 'selected' : '' }}>Sí</option>
            <option value="No" {{ $guest->status == 'No' ? 'selected' : '' }}>No</option>
            <option value="Tal vez" {{ $guest->status == 'Tal vez' ? 'selected' : '' }}>Tal vez</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Notas</label>
        <textarea name="notes" class="form-control">{{ $guest->notes }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
