@extends('layouts.app')
@section('content')
<div class="container py-4">
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 m-0">Citas</h1>
    @if(method_exists($user,'esDoctor') && $user->esDoctor())
      <a class="btn btn-primary btn-sm" href="{{ route('citas.create') }}">Nueva cita</a>
    @endif
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="table-responsive">
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Fecha</th>
          <th>Título</th>
          <th>{{ $user->esDoctor() ? 'Paciente' : 'Doctor' }}</th>
          <th>Estado</th>
          <th style="width:160px">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($items as $it)
        <tr>
          <td>{{ $it->fecha->format('Y-m-d H:i') }}</td>
          <td>{{ $it->titulo }}</td>
          <td>
            @if($user->esDoctor())
              {{ optional($it->paciente)->name }}
            @else
              {{ optional($it->doctor)->name }}
            @endif
          </td>
          <td><span class="badge bg-secondary">{{ $it->estado }}</span></td>
          <td>
            <a class="btn btn-sm btn-secondary" href="{{ route('citas.show', $it->id) }}">Ver</a>
            @if($user->esDoctor())
              <a class="btn btn-sm btn-warning" href="{{ route('citas.edit', $it->id) }}">Editar</a>
              <form class="d-inline" method="POST" action="{{ route('citas.destroy', $it->id) }}">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
              </form>
            @endif
          </td>
        </tr>
        @empty
          <tr><td colspan="5" class="text-center">Sin citas.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>

  {{ $items->links() }}
</div>
@endsection
