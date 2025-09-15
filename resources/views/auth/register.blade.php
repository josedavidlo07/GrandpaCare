@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-lg rounded-4">
                <div class="card-header bg-primary text-white text-center py-4">
                    <h4>{{ __('Bienvenido a GrandpaCare') }}</h4>
                    <p class="lead">{{ __('Crea una cuenta para comenzar a usar nuestros servicios.') }}</p>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name input -->
                        <div class="mb-4">
                            <label for="name" class="form-label">{{ __('Nombre Completo') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus placeholder="Introduce tu nombre completo">
                            
                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Email input -->
                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Correo Electrónico') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="Introduce tu correo electrónico">
                            
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="mb-4">
                            <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required placeholder="Crea una contraseña segura">
                            
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <!-- Confirm Password input -->
                        <div class="mb-4">
                            <label for="password-confirm" class="form-label">{{ __('Confirmar Contraseña') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirma tu contraseña">
                        </div>

                        <!-- Submit button -->
                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Registrarse') }}
                            </button>
                        </div>

                        <!-- Login link -->
                        <div class="text-center mt-3">
                            <p>{{ __('¿Ya tienes cuenta?') }} <a href="{{ route('login') }}" class="btn btn-link">{{ __('Iniciar sesión') }}</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for enhancements -->
@push('styles')
    <style>
        body {
            background: linear-gradient(135deg, #a3c7f2, #e6f0fc);
            font-family: 'Arial', sans-serif;
        }

        .card {
            border: none;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 20px;
        }

        .card-header {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
            background: #6c63ff;
        }

        .btn-primary {
            background: #6c63ff;
            border: none;
        }

        .btn-primary:hover {
            background: #5c53e1;
        }

        .btn-link {
            color: #6c63ff;
        }

        .btn-link:hover {
            text-decoration: underline;
        }

        .form-label {
            font-weight: 600;
        }

        .form-control {
            border-radius: 1.5rem;
            padding: 15px;
            font-size: 1rem;
        }

        .form-check-label {
            font-weight: 500;
        }

        .invalid-feedback {
            font-size: 0.875rem;
        }

        .lead {
            font-size: 1.25rem;
            font-weight: 500;
        }
    </style>
@endpush
@endsection
