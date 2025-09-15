@extends('layouts.app')

@section('content')
  <div class="container py-4">
    <h1 class="section-title mb-4">Gestionar Medicamentos</h1>
    <p class="muted mb-4">Gestiona los medicamentos asignados a los pacientes.</p>

    <!-- Tabla de medicamentos -->
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table align-middle">
            <thead>
              <tr>
                <th>Paciente</th>
                <th>Nombre</th>
                <th>Dosis</th>
                <th>Hora</th>
                <th class="text-end">Acciones</th>
              </tr>
            </thead>
            <tbody>
              @foreach($medicamentos as $medicamento)
                <tr>
                  <td>{{ optional($medicamento->paciente)->name }}</td>
                  <td>{{ $medicamento->nombre }}</td>
                  <td>{{ $medicamento->dosis }}</td>
                  <td>{{ $medicamento->hora }}</td>
                  <td class="text-end">
                    <a href="{{ route('home.medicamento.edit', $medicamento->id) }}" class="btn btn-sm btn-outline-secondary">
                      <i class="bi bi-pencil"></i> Editar
                    </a>
                    <form action="{{ route('home.medicamento.destroy', $medicamento->id) }}" method="POST" style="display: inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="bi bi-trash"></i> Eliminar
                      </button>
                    </form>
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
