<!-- resources/views/salud/show.blade.php -->
@extends('layouts.app')

@section('content')
    <h1 class="mb-4">Registro de Salud</h1>

    <p><strong>Presión Arterial:</strong> {{ $salud->presion_arterial }}</p>
    <p><strong>Glucosa:</strong> {{ $salud->glucosa }}</p>
    <p><strong>Fecha:</strong> {{ $salud->fecha }}</p>

    <a href="{{ url('/salud') }}" class="btn btn-secondary">Volver a la lista</a>
@endsection
