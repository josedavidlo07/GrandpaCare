@extends('layouts.app')

@section('content')
  <div class="container py-4">

    {{-- Título y bienvenida --}}
    <h1 class="section-title mb-4">Detalles del Paciente</h1>
    <p class="muted mb-4">Información del paciente: {{ $paciente->name }}</p>

    {{-- Información del paciente --}}
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h5 class="card-title">Datos Personales</h5>
        <p class="card-text"><strong>Nombre:</strong> {{ $paciente->name }}</p>
        <p class="card-text"><strong>Email:</strong> {{ $paciente->email }}</p>
        <p class="card-text"><strong>Teléfono:</strong> {{ $paciente->telefono ?? 'No disponible' }}</p>
        <!-- Aquí puedes agregar más campos como edad, dirección, etc. -->
      </div>
    </div>

    {{-- Historial de Medicamentos --}}
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h5 class="card-title">Medicamentos Asignados</h5>
        <p class="card-text">Medicamentos que se le han asignado a este paciente.</p>

        <ul>
          @foreach($paciente->medicamentos as $medicamento)
            <li>{{ $medicamento->nombre }} - {{ $medicamento->dosis }} - {{ $medicamento->hora }}</li>
          @endforeach
        </ul>
      </div>
    </div>

    {{-- Historial de Citas --}}
    <div class="card shadow-sm">
      <div class="card-body">
        <h5 class="card-title">Historial de Citas</h5>
        <p class="card-text">Citas pasadas y próximas de este paciente.</p>

        <ul>
          @foreach($paciente->citas as $cita)
            <li>{{ $cita->fecha }} - {{ $cita->titulo }}</li>
          @endforeach
        </ul>
      </div>
    </div>

  </div>
@endsection
