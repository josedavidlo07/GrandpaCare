@extends('layouts.app')

@section('content')
  <div class="container py-4">

    {{-- Título y bienvenida --}}
    <h1 class="section-title mb-4">Mi inicio</h1>
    <p class="muted mb-4">Hola, {{ $user->name }}.</p>

    {{-- Menú de opciones --}}
    <div class="row g-3 mb-4">
      <div class="col-12 col-lg-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="stat mb-2">
              <div class="icon"><i class="bi bi-calendar2-week"></i></div>
              <div>
                <div class="muted small">Próximas citas</div>
                <div class="value">{{ $proximasCitas->count() }}</div>
              </div>
            </div>
            <div class="muted small">Próximas 24-48 h</div>
          </div>
        </div>
      </div>

      

      <div class="col-12 col-lg-4">
        <div class="card h-100">
          <div class="card-body">
            <div class="stat mb-2">
              <div class="icon"><i class="bi bi-capsule-pill"></i></div>
              <div>
                <div class="muted small">Medicamentos activos</div>
                <div class="value">{{ $meds->count() }}</div>
              </div>
            </div>
            <div class="muted small">Para hoy</div>
          </div>
        </div>
      </div>
    </div>

    {{-- Medicamentos --}}
    <div class="card mb-4">
      <div class="card-header bg-white">
        <strong><i class="bi bi-capsule-pill me-1"></i> Mis medicamentos</strong>
      </div>
      <div class="card-body">
        @if($meds->isEmpty())
          <div class="empty text-center"><i class="bi bi-clipboard2-x display-6 d-block mb-2"></i>No tienes medicamentos activos.</div>
        @else
          <div class="table-responsive">
            <table class="table align-middle">
              <thead><tr><th>Hora</th><th>Nombre</th><th>Dosis</th><th>Indicaciones</th></tr></thead>
              <tbody>
                @foreach($meds as $m)
                  <tr>
                    <td>{{ $m->hora ? \Carbon\Carbon::parse($m->hora)->format('H:i') : '—' }}</td>
                    <td class="fw-semibold">{{ $m->nombre }}</td>
                    <td>{{ $m->dosis ?? '—' }}</td>
                    <td class="muted">{{ $m->indicaciones ?? '—' }}</td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @endif
      </div>
    </div>

    {{-- Citas --}}
    <div class="card">
      <div class="card-header bg-white">
        <strong><i class="bi bi-calendar2-event me-1"></i> Mis próximas citas</strong>
      </div>
      <div class="card-body">
        @if($proximasCitas->isEmpty())
          <div class="empty text-center"><i class="bi bi-calendar2-x display-6 d-block mb-2"></i>No tienes citas próximas.</div>
        @else
          <div class="table-responsive">
            <table class="table align-middle">
              <thead><tr><th>Fecha</th><th>Título</th><th>Con</th><th class="text-end">Acciones</th></tr></thead>
              <tbody>
                @foreach($proximasCitas as $c)
                  <tr>
                    <td>{{ $c->fecha->format('Y-m-d H:i') }}</td>
                    <td>{{ $c->titulo }}</td>
                    <td>{{ optional($c->doctor)->name }}</td>
                    <td class="text-end">
                      <a class="btn btn-sm btn-outline-secondary" href="{{ route('citas.show', $c->id) }}"><i class="bi bi-eye"></i></a>
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
