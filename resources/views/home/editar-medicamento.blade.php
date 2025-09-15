@extends('layouts.app')

@section('content')
  <div class="container py-4">

    <h1 class="section-title mb-4">Editar Medicamento</h1>

    <form action="{{ route('home.medicamento.update', $medicamento->id) }}" method="POST">
      @csrf
      @method('PUT')

      <div class="card shadow-sm mb-4">
        <div class="card-body">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $medicamento->nombre }}" required>
          </div>

          <div class="mb-3">
            <label for="dosis" class="form-label">Dosis</label>
            <input type="text" class="form-control" id="dosis" name="dosis" value="{{ $medicamento->dosis }}" required>
          </div>

          <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" class="form-control" id="hora" name="hora" value="{{ $medicamento->hora }}" required>
          </div>

          <div class="mb-3">
            <label for="indicaciones" class="form-label">Indicaciones</label>
            <textarea class="form-control" id="indicaciones" name="indicaciones">{{ $medicamento->indicaciones }}</textarea>
          </div>

          <button type="submit" class="btn btn-gradient">Guardar cambios</button>
        </div>
      </div>
    </form>
  </div>
@endsection
