@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Lista de Invitados</h2>
    <a href="{{ route('guests.create') }}" class="btn btn-primary">Agregar Invitado</a>
</div>

<h4 class="mt-4">Resumen General</h4>
    <table class="table table-bordered text-center mb-5">
        <thead class="table-light">
            <tr>
                <th></th>
                <th>Total Personas</th>
                <th>Adultos</th>
                <th>Niños</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Total General</th>
                <td>{{ $yesCount + $noCount + $maybeCount }}</td>
                <td>{{ ($yesCount + $noCount + $maybeCount) - ($childYes + $childNo + $childMaybe) }}</td>
                <td>{{ $childYes + $childNo + $childMaybe }}</td>
            </tr>
            <tr>
                <th>🎩 Novio</th>
                <td>{{ $novioYes + $novioNo + $novioMaybe }}</td>
                <td>{{ ($novioYes + $novioNo + $novioMaybe) - ($novioChildYes + $novioChildNo + $novioChildMaybe) }}</td>
                <td>{{ $novioChildYes + $novioChildNo + $novioChildMaybe }}</td>
            </tr>
            <tr>
                <th>👰 Novia</th>
                <td>{{ $noviaYes + $noviaNo + $noviaMaybe }}</td>
                <td>{{ ($noviaYes + $noviaNo + $noviaMaybe) - ($noviaChildYes + $noviaChildNo + $noviaChildMaybe) }}</td>
                <td>{{ $noviaChildYes + $noviaChildNo + $noviaChildMaybe }}</td>
            </tr>
        </tbody>
    </table>

<!-- Filtros -->
<form method="GET" class="row row-cols-lg-auto g-3 align-items-end mb-4">
    <div class="col">
        <label class="form-label">Grupo</label>
        <input type="text" name="group" class="form-control" value="{{ $selectedGroup }}">
    </div>

    <div class="col">
        <label class="form-label">Estado</label>
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

<!-- Contadores generales -->
<div class="alert alert-info text-center mb-5">
    <p>TOTALES</p>
    <strong>✔ Confirmados:</strong> {{ $yesCount }} |
    <strong>❌ No asisten:</strong> {{ $noCount }} |
    <strong>❓ Tal vez:</strong> {{ $maybeCount }} |
    <strong>🧒 Niños:</strong> {{ $childYes + $childNo + $childMaybe }}
</div>

<div class="row">
    <!-- Invitados del Novio -->
    <div class="col-md-6 mb-4">
        <h3>🎩 Invitados del Novio</h3>
        <div class="mb-2">
            <strong>✔ Sí:</strong> {{ $novioYes }} |
            <strong>❌ No:</strong> {{ $novioNo }} |
            <strong>❓ Tal vez:</strong> {{ $novioMaybe }} |
            <strong>🧒 Niños:</strong> {{ $novioChildYes + $novioChildNo + $novioChildMaybe }}
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Grupo</th>
                    <th>Adultos</th>
                    <th>Niños</th>
                    <th>Estado</th>
                    <th>Notas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guests->where('side', 'novio') as $guest)
                <tr>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->group }}</td>
                    <td>{{ 1 + $guest->adult_companions }}</td>
                    <td>{{ $guest->child_companions }}</td>
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
            <tfoot>
                <tr class="table-secondary fw-bold">
                    <td colspan="2">Totales</td>
                    <td>{{ $novioAdultTotal + $guests->where('side', 'novio')->count() }}</td>
                    <td>{{ $novioChildTotal }}</td>
                    <td colspan="3">Personas totales: {{ $novioPeopleTotal }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Invitados de la Novia -->
    <div class="col-md-6 mb-4">
        <h3>👰 Invitados de la Novia</h3>
        <div class="mb-2">
            <strong>✔ Sí:</strong> {{ $noviaYes }} |
            <strong>❌ No:</strong> {{ $noviaNo }} |
            <strong>❓ Tal vez:</strong> {{ $noviaMaybe }} |
            <strong>🧒 Niños:</strong> {{ $noviaChildYes + $noviaChildNo + $noviaChildMaybe }}
        </div>

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Nombre</th>
                    <th>Grupo</th>
                    <th>Adultos</th>
                    <th>Niños</th>
                    <th>Estado</th>
                    <th>Notas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($guests->where('side', 'novia') as $guest)
                <tr>
                    <td>{{ $guest->name }}</td>
                    <td>{{ $guest->group }}</td>
                    <td>{{ 1 + $guest->adult_companions }}</td>
                    <td>{{ $guest->child_companions }}</td>
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
            <tfoot>
                <tr class="table-secondary fw-bold">
                    <td colspan="2">Totales</td>
                    <td>{{ $noviaAdultTotal + $guests->where('side', 'novia')->count() }}</td>
                    <td>{{ $noviaChildTotal }}</td>
                    <td colspan="3">Personas totales: {{ $noviaPeopleTotal }}</td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
