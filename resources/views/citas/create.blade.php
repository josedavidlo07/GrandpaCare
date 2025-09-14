@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1 class="h3 mb-3">Nueva cita</h1>
  <form method="POST" action="{{ route('citas.store') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Paciente</label>
      <select name="patient_id" class="form-select" required>
        <option value="">Seleccione…</option>
        @foreach($pacientes as $p)
          <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->email }})</option>
        @endforeach
      </select>
      @error('patient_id')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input name="titulo" class="form-control" required>
      @error('titulo')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control" rows="3"></textarea>
      @error('descripcion')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Fecha y hora</label>
      <input type="datetime-local" name="fecha" class="form-control" required>
      @error('fecha')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Estado</label>
      <select name="estado" class="form-select">
        <option value="programada">Programada</option>
        <option value="completada">Completada</option>
        <option value="cancelada">Cancelada</option>
      </select>
      @error('estado')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Guardar</button>
    <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
  </form>
</div>
@endsection
