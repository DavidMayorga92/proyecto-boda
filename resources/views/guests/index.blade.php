@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Lista de Invitados</h2>
    <a href="{{ route('guests.create') }}" class="btn btn-primary">Agregar Invitado</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<div class="alert alert-info d-flex justify-content-around text-center">
    <div>
        <strong>✔ Confirmados:</strong><br>{{ $yesCount }}
    </div>
    <div>
        <strong>❌ No asisten:</strong><br>{{ $noCount }}
    </div>
    <div>
        <strong>❓ Tal vez:</strong><br>{{ $maybeCount }}
    </div>
</div>

<form method="GET" class="row row-cols-lg-auto g-3 align-items-end mb-4">
    <div class="col">
        <label class="form-label">Grupo</label>
        <input type="text" name="group" class="form-control" value="{{ $selectedGroup }}">
    </div>

    <div class="col">
        <label class="form-label">Asistencia</label>
        <select name="status" class="form-select">
            <option value="">-- Todos --</option>
            <option value="Sí" {{ $selectedStatus == 'Sí' ? 'selected' : '' }}>Sí</option>
            <option value="No" {{ $selectedStatus == 'No' ? 'selected' : '' }}>No</option>
            <option value="Tal vez" {{ $selectedStatus == 'Tal vez' ? 'selected' : '' }}>Tal vez</option>
        </select>
    </div>

    <div class="col">
        <button type="submit" class="btn btn-outline-primary">Filtrar</button>
        <a href="{{ route('guests.index') }}" class="btn btn-outline-secondary">Limpiar</a>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Nombre</th>
            <th>Grupo</th>
            <th>Acompañantes</th>
            <th>Asistencia</th>
            <th>Notas</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($guests as $guest)
        <tr>
            <td>{{ $guest->name }}</td>
            <td>{{ $guest->group }}</td>
            <td>{{ $guest->companions }}</td>
            <td>{{ $guest->status }}</td>
            <td>{{ $guest->notes }}</td>
            <td class="d-flex gap-2">
                <a href="{{ route('guests.edit', $guest) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                <form action="{{ route('guests.destroy', $guest) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar invitado?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
