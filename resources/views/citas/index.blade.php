@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between align-items-end mb-3">
    <div>
      <h1 class="section-title mb-1">Citas</h1>
      <div class="muted">Listado de tus citas.</div>
    </div>
    @if(method_exists($user,'esDoctor') && $user->esDoctor())
      <a class="btn btn-gradient" href="{{ route('citas.create') }}"><i class="bi bi-calendar2-plus me-1"></i> Nueva cita</a>
    @endif
  </div>

  <div class="card">
    <div class="card-body">
      @if($items->isEmpty())
        <div class="empty text-center"><i class="bi bi-calendar2-x display-6 d-block mb-2"></i>Sin citas.</div>
      @else
        <div class="table-responsive">
          <table class="table table-hover align-middle">
            <thead>
            <tr>
              <th>Fecha</th>
              <th>Título</th>
              <th>{{ $user->esDoctor() ? 'Paciente' : 'Doctor' }}</th>
              <th>Estado</th>
              <th class="text-end" style="width:180px">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $it)
              <tr>
                <td class="fw-semibold">{{ $it->fecha->format('Y-m-d H:i') }}</td>
                <td>{{ $it->titulo }}</td>
                <td>
                  @if($user->esDoctor())
                    {{ optional($it->paciente)->name }}
                  @else
                    {{ optional($it->doctor)->name }}
                  @endif
                </td>
                <td>
                  @php
                    $map = ['programada'=>'primary','completada'=>'success','cancelada'=>'danger'];
                    $color = $map[$it->estado] ?? 'secondary';
                  @endphp
                  <span class="badge text-bg-{{ $color }}">{{ ucfirst($it->estado) }}</span>
                </td>
                <td class="text-end">
                  <a class="btn btn-sm btn-outline-secondary" href="{{ route('citas.show', $it->id) }}"><i class="bi bi-eye"></i></a>
                  @if($user->esDoctor())
                    <a class="btn btn-sm btn-outline-warning" href="{{ route('citas.edit', $it->id) }}"><i class="bi bi-pencil"></i></a>
                    <form class="d-inline" method="POST" action="{{ route('citas.destroy', $it->id) }}">
                      @csrf @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar la cita?')"><i class="bi bi-trash"></i></button>
                    </form>
                  @endif
                </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        <div class="mt-3">
          {{ $items->links() }}
        </div>
      @endif
    </div>
  </div>
@endsection

