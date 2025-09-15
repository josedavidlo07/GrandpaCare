@extends('layouts.app')

@section('content')
  <div class="container py-4">

    {{-- Título y bienvenida --}}
    <h1 class="section-title mb-4">Asignar Resultados de Salud</h1>
    <p class="muted mb-4">Agregar los resultados de salud para {{ $paciente->name }}.</p>

    {{-- Formulario para asignar resultados de salud --}}
    <form method="POST" action="{{ route('home.store-salud', $paciente->id) }}">
      @csrf

      <div class="row g-3">
        <div class="col-md-6">
          <label for="presion_sistolica" class="form-label">Presión Sistólica (mmHg)</label>
          <input type="number" class="form-control" name="presion_sistolica" id="presion_sistolica" required>
        </div>

        <div class="col-md-6">
          <label for="presion_diastolica" class="form-label">Presión Diastólica (mmHg)</label>
          <input type="number" class="form-control" name="presion_diastolica" id="presion_diastolica" required>
        </div>

        <div class="col-md-6">
          <label for="glucosa_mg_dl" class="form-label">Glucosa (mg/dL)</label>
          <input type="number" class="form-control" name="glucosa_mg_dl" id="glucosa_mg_dl" required>
        </div>

        <div class="col-md-6">
          <label for="frecuencia_cardiaca" class="form-label">Frecuencia Cardiaca (lpm)</label>
          <input type="number" class="form-control" name="frecuencia_cardiaca" id="frecuencia_cardiaca" required>
        </div>

        <div class="col-md-6">
          <label for="peso_kg" class="form-label">Peso (kg)</label>
          <input type="number" step="0.01" class="form-control" name="peso_kg" id="peso_kg" required>
        </div>

        <div class="col-md-6">
          <label for="estatura_cm" class="form-label">Estatura (cm)</label>
          <input type="number" step="0.1" class="form-control" name="estatura_cm" id="estatura_cm" required>
        </div>

        <div class="col-md-12">
          <label for="fecha" class="form-label">Fecha del control</label>
          <input type="date" class="form-control" name="fecha" id="fecha" required>
        </div>
      </div>

      <button type="submit" class="btn btn-gradient mt-3">Registrar</button>
    </form>

  </div>
@endsection
