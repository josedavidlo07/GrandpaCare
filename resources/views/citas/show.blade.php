@extends('layouts.app')
@section('content')
  <div class="d-flex justify-content-between align-items-end mb-3">
    <div>
      <h1 class="section-title mb-1">Detalle de cita</h1>
      <div class="muted">Información completa de la cita.</div>
    </div>
    <a href="{{ route('citas.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left me-1"></i> Volver</a>
  </div>

  <div class="card">
    <div class="card-body">
      <div class="row g-3">
        <div class="col-12 col-lg-6">
          <div class="card card-plain">
            <div class="card-body">
              <div class="muted small">Fecha</div>
              <div class="fs-5 fw-bold">{{ $cita->fecha->format('Y-m-d H:i') }}</div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="card card-plain">
            <div class="card-body">
              <div class="muted small">Estado</div>
              @php
                $map = ['programada'=>'primary','completada'=>'success','cancelada'=>'danger'];
                $color = $map[$cita->estado] ?? 'secondary';
              @endphp
              <span class="badge text-bg-{{ $color }} fs-6">{{ ucfirst($cita->estado) }}</span>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="card card-plain">
            <div class="card-body">
              <div class="muted small">Paciente</div>
              <div class="fw-semibold">{{ optional($cita->paciente)->name }}</div>
            </div>
          </div>
        </div>
        <div class="col-12 col-lg-6">
          <div class="card card-plain">
            <div class="card-body">
              <div class="muted small">Título</div>
              <div class="fw-semibold">{{ $cita->titulo }}</div>
            </div>
          </div>
        </div>
        <div class="col-12">
          <div class="card card-plain">
            <div class="card-body">
              <div class="muted small mb-1">Descripción</div>
              <div>{{ $cita->descripcion ?: '—' }}</div>
            </div>
          </div>
        </div>
      </div>

      <div class="mt-3">
        <a class="btn btn-outline-secondary" href="{{ route('citas.index') }}"><i class="bi bi-arrow-left me-1"></i> Volver</a>
        @if($user->esDoctor())
          <a class="btn btn-outline-warning" href="{{ route('citas.edit', $cita->id) }}"><i class="bi bi-pencil me-1"></i> Editar</a>
        @endif
      </div>
    </div>
  </div>
@endsection
