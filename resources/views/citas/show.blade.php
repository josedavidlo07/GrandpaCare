@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1 class="h3 mb-3">Cita</h1>
  <p class="mb-1"><strong>Título:</strong> {{ $cita->titulo }}</p>
  <p class="mb-1"><strong>Fecha:</strong> {{ $cita->fecha->format('Y-m-d H:i') }}</p>
  <p class="mb-1"><strong>Estado:</strong> <span class="badge bg-secondary">{{ $cita->estado }}</span></p>
  <p class="mb-1"><strong>Paciente:</strong> {{ optional($cita->paciente)->name }}</p>
  <p class="mb-3"><strong>Descripción:</strong><br>{{ $cita->descripcion }}</p>
  <a class="btn btn-outline-secondary" href="{{ route('citas.index') }}">Volver</a>
</div>
@endsection
