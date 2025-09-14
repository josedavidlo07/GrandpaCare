@extends('layouts.app')
@section('content')
<div class="container py-4">

  <div class="d-flex justify-content-between align-items-center mb-3">
    <div>
      <h1 class="h3 mb-1">Inicio — Doctor</h1>
      <div class="text-muted">Bienvenido(a), {{ $doctor->name }}.</div>
    </div>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button class="btn btn-outline-danger">Cerrar sesión</button>
    </form>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-md-6">
      <a class="btn btn-primary w-100 p-3" href="{{ route('citas.create') }}">+ Nueva cita</a>
    </div>
    <div class="col-12 col-md-6">
      <a class="btn btn-outline-secondary w-100 p-3" href="{{ route('citas.index') }}">Ver todas las citas</a>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="text-muted small">Pacientes asignados</div>
          <div class="display-6">{{ $totalPacientes }}</div>
        </div>
      </div>
    </div>
    <div class="col-12 col-md-6">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="text-muted small">Próximas citas (5)</div>
          <div class="display-6">{{ $proximasCitas->count() }}</div>
        </div>
      </div>
    </div>
  </div>

  <div class="card shadow-sm">
    <div class="card-header bg-white"><strong>Próximas citas</strong></div>
    <div class="card-body">
      @if($proximasCitas->isEmpty())
        <p class="text-muted mb-0">No hay citas próximas.</p>
      @else
        <div class="table-responsive">
          <table class="table table-sm align-middle">
            <thead><tr><th>Fecha</th><th>Paciente</th><th>Título</th><th></th></tr></thead>
            <tbody>
              @foreach($proximasCitas as $c)
                <tr>
                  <td>{{ $c->fecha->format('Y-m-d H:i') }}</td>
                  <td>{{ optional($c->paciente)->name }}</td>
                  <td>{{ $c->titulo }}</td>
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
    <div class="card-footer bg-white text-end">
      <a href="{{ route('citas.index') }}" class="btn btn-link">Ver todas &rarr;</a>
    </div>
  </div>

</div>
@endsection
