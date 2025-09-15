@extends('layouts.app')

@section('content')
  <h1 class="section-title mb-3">Asignar Medicamento</h1>

  <form method="POST" action="{{ route('home.store-medicamento') }}">
    @csrf
    <div class="mb-3">
      <label class="form-label">Paciente</label>
      <select name="patient_id" class="form-select @error('patient_id') is-invalid @enderror" required>
        <option value="">Seleccione...</option>
        @foreach($pacientes as $p)
          <option value="{{ $p->id }}">{{ $p->name }} ({{ $p->email }})</option>
        @endforeach
      </select>
      @error('patient_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Nombre del Medicamento</label>
      <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror" required>
      @error('nombre')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Dosis</label>
      <input type="text" name="dosis" class="form-control @error('dosis') is-invalid @enderror" required>
      @error('dosis')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Indicaciones</label>
      <textarea name="indicaciones" rows="3" class="form-control @error('indicaciones') is-invalid @enderror"></textarea>
      @error('indicaciones')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Hora de toma</label>
      <input type="time" name="hora" class="form-control @error('hora') is-invalid @enderror" required>
      @error('hora')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <button class="btn btn-gradient">Asignar Medicamento</button>
  </form>
@endsection
