@extends('layouts.app')

@section('content')
<div class="text-center">
    <h2>Hola, {{ $guest->name }} 👋</h2>
    <p>¿Confirmas tu asistencia a nuestra boda?</p>

    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('guests.confirm', $guest) }}" class="mt-4">
        @csrf
        <div class="mb-3">
            <select name="status" class="form-select" required>
                <option value="">-- Selecciona una opción --</option>
                <option value="Sí" {{ $guest->status == 'Sí' ? 'selected' : '' }}>Sí asistiré 🎉</option>
                <option value="No" {{ $guest->status == 'No' ? 'selected' : '' }}>No podré asistir 😔</option>
                <option value="Tal vez" {{ $guest->status == 'Tal vez' ? 'selected' : '' }}>Aún no estoy seguro 🤔</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
</div>
@endsection
