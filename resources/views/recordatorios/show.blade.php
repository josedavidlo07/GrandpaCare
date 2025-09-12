<!-- resources/views/recordatorios/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="mb-4">{{ $recordatorio->titulo }}</h1>

    <p><strong>Descripción:</strong> {{ $recordatorio->descripcion }}</p>
    <p><strong>Fecha:</strong> {{ $recordatorio->fecha }}</p>

    <!-- Botón para volver a la lista de recordatorios -->
    <a href="{{ url('/recordatorios') }}" class="btn btn-secondary">Volver a la lista</a>
@endsection
