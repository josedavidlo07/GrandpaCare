<!-- resources/views/recordatorios/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Mis Recordatorios</h1>

    <!-- Tabla de Recordatorios -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recordatorios as $recordatorio)
                    <tr>
                        <td>{{ $recordatorio->titulo }}</td>
                        <td>{{ $recordatorio->descripcion }}</td>
                        <td>{{ $recordatorio->fecha }}</td>
                        <td>
                            <!-- Ver Recordatorio -->
                            <a href="{{ url('/recordatorios/' . $recordatorio->id) }}" class="btn btn-info btn-sm">Ver</a>
                            <!-- Eliminar Recordatorio -->
                            <form action="{{ route('recordatorios.destroy', $recordatorio->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Botón de Agregar Recordatorio -->
    <a href="{{ route('recordatorios.create') }}" class="btn btn-success btn-sm">Agregar Recordatorio</a>
@endsection
