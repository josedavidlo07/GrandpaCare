@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1 class="h3 mb-3">Editar registro de salud</h1>

  <form method="POST" action="{{ route('salud.update', $registro->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Presión arterial</label>
      <input name="presion_arterial" class="form-control" value="{{ old('presion_arterial', $registro->presion_arterial) }}" required>
      @error('presion_arterial')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Glucosa (mg/dL)</label>
      <input type="number" step="0.01" name="glucosa" class="form-control" value="{{ old('glucosa', $registro->glucosa) }}">
      @error('glucosa')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Fecha y hora</label>
      <input type="datetime-local" name="fecha" class="form-control" value="{{ old('fecha', $registro->fecha->format('Y-m-d\TH:i')) }}" required>
      @error('fecha')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('salud.index') }}" class="btn btn-outline-secondary">Cancelar</a>
  </form>
</div>
@endsection
