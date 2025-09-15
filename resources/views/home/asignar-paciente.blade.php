@extends('layouts.app')

@section('content')
  <h1 class="section-title mb-3">Asignar Paciente</h1>

  <form method="POST" action="{{ route('home.store-paciente') }}">
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

    <button class="btn btn-gradient">Asignar Paciente</button>
  </form>
@endsection
