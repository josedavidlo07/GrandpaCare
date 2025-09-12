<!-- resources/views/salud/index.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Mis Registros de Salud</h1>

    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Presión Arterial</th>
                    <th>Glucosa</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($salud as $registro)
                    <tr>
                        <td>{{ $registro->presion_arterial }}</td>
                        <td>{{ $registro->glucosa }}</td>
                        <td>{{ $registro->fecha }}</td>
                        <td>
                            <a href="{{ url('/salud/' . $registro->id) }}" class="btn btn-info btn-sm">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('salud.create') }}" class="btn btn-success btn-sm">Agregar Registro de Salud</a>
@endsection
