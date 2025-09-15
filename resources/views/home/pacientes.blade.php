@extends('layouts.app')

@section('content')
  <div class="container py-4">

    {{-- Título y bienvenida --}}
    <h1 class="section-title mb-4">Pacientes Asignados</h1>
    <p class="muted mb-4">Lista de pacientes asignados a {{ Auth::user()->name }}.</p>

    {{-- Tabla de pacientes asignados --}}
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Correo Electrónico</th>
                <th class="text-end">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($pacientes as $paciente)
                <tr>
                  <td>{{ $paciente->name }}</td>
                  <td>{{ $paciente->email }}</td>
                  <td class="text-end">
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('home.paciente.show', $paciente->id) }}">
                      Ver detalles
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
@endsection
