@extends('layouts.app')
@section('content')
  <h1 class="section-title mb-3">Editar cita</h1>

  <div class="card">
    <div class="card-body">
      <form method="POST" action="{{ route('citas.update', $cita->id) }}">
        @csrf @method('PUT')

        <div class="row g-3">
          <div class="col-12 col-md-6">
            <label class="form-label">Paciente</label>
            <select name="patient_id" class="form-select @error('patient_id') is-invalid @enderror" required>
              @foreach($pacientes as $p)
                <option value="{{ $p->id }}" @if($p->id===$cita->patient_id) selected @endif>{{ $p->name }} ({{ $p->email }})</option>
              @endforeach
            </select>
            @error('patient_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-6">
            <label class="form-label">Fecha y hora</label>
            <div class="input-group">
              <span class="input-group-text"><i class="bi bi-clock"></i></span>
              <input type="datetime-local" name="fecha" class="form-control @error('fecha') is-invalid @enderror" value="{{ $cita->fecha->format('Y-m-d\TH:i') }}" required>
            </div>
            @error('fecha')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label class="form-label">Título</label>
            <input name="titulo" class="form-control @error('titulo') is-invalid @enderror" value="{{ $cita->titulo }}" required>
            @error('titulo')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12">
            <label class="form-label">Descripción</label>
            <textarea name="descripcion" rows="3" class="form-control @error('descripcion') is-invalid @enderror">{{ $cita->descripcion }}</textarea>
            @error('descripcion')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-12 col-md-4">
            <label class="form-label">Estado</label>
            <select name="estado" class="form-select">
              @foreach(['programada','completada','cancelada'] as $st)
                <option value="{{ $st }}" @if($cita->estado===$st) selected @endif>{{ ucfirst($st) }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="d-flex gap-2 mt-4">
          <button class="btn btn-gradient"><i class="bi bi-save2 me-1"></i> Actualizar</button>
          <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
@endsection
