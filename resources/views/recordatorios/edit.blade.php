@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1 class="h3 mb-3">Editar Recordatorio</h1>

  <form method="POST" action="{{ route('recordatorios.update', $recordatorio->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input name="titulo" class="form-control" value="{{ old('titulo', $recordatorio->titulo) }}" required>
      @error('titulo')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control" rows="3">{{ old('descripcion', $recordatorio->descripcion) }}</textarea>
      @error('descripcion')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Fecha y hora</label>
      <input type="datetime-local" name="fecha" class="form-control" value="{{ old('fecha', $recordatorio->fecha->format('Y-m-d\TH:i')) }}" required>
      @error('fecha')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('recordatorios.index') }}" class="btn btn-outline-secondary">Cancelar</a>
  </form>
</div>
@endsection
