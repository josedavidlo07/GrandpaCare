@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1 class="h3 mb-3">Editar cita</h1>
  <form method="POST" action="{{ route('citas.update', $cita->id) }}">
    @csrf @method('PUT')
    <div class="mb-3">
      <label class="form-label">Paciente</label>
      <select name="patient_id" class="form-select" required>
        @foreach($pacientes as $p)
          <option value="{{ $p->id }}" @if($p->id===$cita->patient_id) selected @endif>{{ $p->name }} ({{ $p->email }})</option>
        @endforeach
      </select>
      @error('patient_id')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input name="titulo" class="form-control" value="{{ $cita->titulo }}" required>
      @error('titulo')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea name="descripcion" class="form-control" rows="3">{{ $cita->descripcion }}</textarea>
      @error('descripcion')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Fecha y hora</label>
      <input type="datetime-local" name="fecha" class="form-control" value="{{ $cita->fecha->format('Y-m-d\TH:i') }}" required>
      @error('fecha')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
      <label class="form-label">Estado</label>
      <select name="estado" class="form-select">
        @foreach(['programada','completada','cancelada'] as $st)
          <option @if($cita->estado===$st) selected @endif value="{{ $st }}">{{ ucfirst($st) }}</option>
        @endforeach
      </select>
      @error('estado')<div class="text-danger small">{{ $message }}</div>@enderror
    </div>
    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
  </form>
</div>
@endsection
