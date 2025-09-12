@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Agregar Registro de Salud</h1>

    <form action="{{ route('salud.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="presion_arterial" class="form-label">Presión Arterial</label>
            <input type="text" class="form-control" id="presion_arterial" name="presion_arterial" required>
        </div>
        <div class="mb-3">
            <label for="glucosa" class="form-label">Glucosa</label>
            <input type="text" class="form-control" id="glucosa" name="glucosa" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Registro de Salud</button>
    </form>
@endsection
