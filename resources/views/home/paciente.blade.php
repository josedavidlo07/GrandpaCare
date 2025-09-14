@extends('layouts.app')

@section('content')
<div class="container py-4">

  {{-- Encabezado --}}
  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h1 class="h3 mb-1">Mi inicio</h1>
      <div class="text-muted">Hola, {{ $user->name }}.</div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn btn-outline-danger">Cerrar sesión</button>
    </form>
  </div>

  {{-- Tarjetas resumen --}}
  <div class="row g-3 mb-4">
    <div class="col-12 col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="text-muted small mb-1">Próximas citas</div>
          <div class="display-6">{{ $proximasCitas->count() }}</div>
          <div class="small text-muted">Próximas 24-48 h</div>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="text-muted small mb-1">Último control</div>
          @if($salud)
            <div class="mb-1">
              <strong>PA:</strong> {{ $salud->presion_sistolica }}/{{ $salud->presion_diastolica }} mmHg
            </div>
            <div class="mb-1">
              <strong>Glucosa:</strong> {{ $salud->glucosa_mg_dl }} mg/dL
            </div>
            <div class="mb-1">
              <strong>FC:</strong> {{ $salud->frecuencia_cardiaca }} lpm
            </div>
            <div>
              <strong>IMC:</strong> {{ $imc ?? '—' }}
            </div>
            <div class="small text-muted mt-1">
              {{ $salud->fecha->format('Y-m-d H:i') }}
            </div>
          @else
            <div class="text-muted">Sin registros aún.</div>
          @endif
        </div>
      </div>
    </div>

    <div class="col-12 col-md-4">
      <div class="card shadow-sm h-100">
        <div class="card-body">
          <div class="text-muted small mb-2">Medicamentos activos</div>
          <div class="display-6">{{ $meds->count() }}</div>
          <div class="small text-muted">Para hoy</div>
        </div>
      </div>
    </div>
  </div>

  {{-- Medicamentos --}}
  <div class="card shadow-sm mb-4">
    <div class="card-header bg-white">
      <strong>Mis medicamentos</strong>
    </div>
    <div class="card-body">
      @if($meds->isEmpty())
        <p class="text-muted mb-0">No tienes medicamentos activos.</p>
      @else
        <div class="table-responsive">
          <table class="table table-sm align-middle">
            <thead>
              <tr>
                <th>Hora</th>
                <th>Nombre</th>
                <th>Dosis</th>
                <th>Indicaciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($meds as $m)
                <tr>
                  <td>{{ $m->hora ? \Carbon\Carbon::parse($m->hora)->format('H:i') : '—' }}</td>
                  <td>{{ $m->nombre }}</td>
                  <td>{{ $m->dosis ?? '—' }}</td>
                  <td class="text-muted">{{ $m->indicaciones ?? '—' }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>

  {{-- Citas --}}
  <div class="card shadow-sm">
    <div class="card-header bg-white">
      <strong>Mis próximas citas</strong>
    </div>
    <div class="card-body">
      @if($proximasCitas->isEmpty())
        <p class="text-muted mb-0">No tienes citas próximas.</p>
      @else
        <div class="table-responsive">
          <table class="table table-sm align-middle">
            <thead>
              <tr>
                <th>Fecha</th>
                <th>Título</th>
                <th>Con</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($proximasCitas as $c)
                <tr>
                  <td>{{ $c->fecha->format('Y-m-d H:i') }}</td>
                  <td>{{ $c->titulo }}</td>
                  <td>{{ optional($c->doctor)->name }}</td>
                  <td class="text-end">
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('citas.show', $c->id) }}">Ver</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>

</div>
@endsection
