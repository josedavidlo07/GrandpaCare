@extends('layouts.app')
@section('content')
  <h1 class="section-title mb-3">Nueva cita</h1>

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('citas.store') }}">
        @csrf

        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label">Paciente</label>
            <select name="patient_id" class="form-select @error('patient_id') is-invalid @enderror" required>
              <option value="">Seleccione…</option>
              @foreach($pacientes as $p)
                <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->email }})</option>
              @endforeach
            </select>
            @error('patient_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">Fecha y hora</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-clock"></i></span>
              <input type="datetime-local" name="fecha" class="form-control @error('fecha') is-invalid @enderror" required>
            </div>
            @error('fecha')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label class="form-label">Título</label>
            <input name="titulo" class="form-control @error('titulo') is-invalid @enderror" required>
            @error('titulo')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" rows="3" class="form-control @error('descripcion') is-invalid @enderror"></textarea>
            @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select">
              <option value="programada">Programada</option>
              <option value="completada">Completada</option>
              <option value="cancelada">Cancelada</option>
            </select>
          </div>
        </div>

        <div class="d-flex gap-2 mt-4">
          <button class="btn btn-gradient"><i class="bi bi-check2-circle me-1"></i> Guardar</button>
          <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
@endsection
