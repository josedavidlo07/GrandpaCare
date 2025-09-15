@extends('layouts.app')

@section('content')
  <div class="container py-4">

    {{-- Título y bienvenida --}}
    <h1 class="section-title mb-4">Panel del Doctor</h1>
    <p class="muted mb-4">Bienvenido(a), {{ Auth::user()->name }}.</p>

    {{-- Menú de opciones --}}
    <div class="row g-3 mb-4">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Asignar Pacientes</h5>
            <p class="card-text">Gestiona y asigna pacientes a este doctor.</p>
            <a href="{{ route('home.asignar-paciente') }}" class="btn btn-outline-primary w-100">
              Asignar Pacientes
            </a>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Asignar Medicamentos</h5>
            <p class="card-text">Asigna medicamentos a los pacientes que tienes a cargo.</p>
            <a href="{{ route('home.asignar-medicamento') }}" class="btn btn-outline-primary w-100">
              Asignar Medicamentos
            </a>
          </div>
        </div>
      </div>

      {{-- Nuevo botón: Gestionar Medicamentos --}}
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Gestionar Medicamentos</h5>
            <p class="card-text">Ver y editar los medicamentos asignados a tus pacientes.</p>
            <a href="{{ route('home.medicamentos') }}" class="btn btn-outline-primary w-100">
              Gestionar Medicamentos
            </a>
          </div>
        </div>
      </div>



      {{-- Ver Pacientes --}}
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Ver Pacientes</h5>
            <p class="card-text">Consulta los pacientes asignados a este doctor.</p>
            <a href="{{ route('home.pacientes') }}" class="btn btn-outline-primary w-100">
              Ver Pacientes
            </a>
          </div>
        </div>
      </div>

    </div>

    {{-- Tarjetas de estadísticas --}}
    <div class="row g-3 mb-4">
      <div class="col-12 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body d-flex justify-content-between">
            <div class="stat">
              <div class="icon"><i class="bi bi-people"></i></div>
              <div>
                <div class="muted small">Pacientes asignados</div>
                <div class="value">{{ $totalPacientes }}</div>
              </div>
            </div>
            <a href="{{ route('home.pacientes') }}" class="btn btn-light">Ver Pacientes</a>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body d-flex justify-content-between">
            <div class="stat">
              <div class="icon"><i class="bi bi-calendar2-week"></i></div>
              <div>
                <div class="muted small">Próximas citas</div>
                <div class="value">{{ $proximasCitas->count() }}</div>
              </div>
            </div>
            <a href="{{ route('citas.index') }}" class="btn btn-light">Ver</a>
          </div>
        </div>
      </div>

      <div class="col-12 col-lg-4">
        <div class="card shadow-sm">
          <div class="card-body d-flex gap-2">
            <a class="btn btn-gradient w-50" href="{{ route('citas.create') }}">
              <i class="bi bi-calendar2-plus me-1"></i> Nueva cita
            </a>
            <a class="btn btn-outline-secondary w-50" href="{{ route('citas.index') }}">
              <i class="bi bi-view-list me-1"></i> Ver todas
            </a>
          </div>
        </div>
      </div>
    </div>

    {{-- Próximas citas --}}
    <div class="card">
      <div class="card-header bg-white">
        <strong><i class="bi bi-clock-history me-1"></i> Próximas citas</strong>
      </div>
      <div class="card-body">
        @if($proximasCitas->isEmpty())
          <div class="empty text-center">
            <i class="bi bi-calendar2-x display-6 d-block mb-2"></i>
            No hay citas próximas.
          </div>
        @else
          <div class="table-responsive">
            <table class="table align-middle">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Paciente</th>
                  <th>Título</th>
                  <th class="text-end">Acciones</th>
                </tr>
              </thead>
              <tbody>
                @foreach($proximasCitas as $c)
                  <tr>
                    <td>{{ $c->fecha->format('Y-m-d H:i') }}</td>
                    <td>{{ optional($c->paciente)->name }}</td>
                    <td>{{ $c->titulo }}</td>
                    <td class="text-end">
                      <a class="btn btn-sm btn-outline-secondary" href="{{ route('citas.show', $c->id) }}">
                        <i class="bi bi-eye"></i>
                      </a>
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
