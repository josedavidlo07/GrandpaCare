@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Agregar Nuevo Recordatorio</h1>

    <form action="{{ route('recordatorios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="datetime-local" class="form-control" id="fecha" name="fecha" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Recordatorio</button>
    </form>
@endsection
