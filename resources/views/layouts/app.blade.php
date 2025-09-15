<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ config('app.name', 'GrandpaCare') }}</title>

  {{-- Bootstrap 5 + Icons + Fuente --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root{
      --brand:#6c63ff; /* Cambia el color de marca aquí */
      --brand-2:#8E2DE2;
      --brand-3:#4A00E0;
      --bg:#f6f7fb;
    }
    html,body{ height:100%; }
    body{
      font-family: 'Inter', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji", sans-serif;
      background: linear-gradient(180deg, #f8f9ff 0%, #f6f7fb 100%);
    }
    .navbar-brand{
      font-weight:800; letter-spacing:.3px;
      background: linear-gradient(135deg, var(--brand-2), var(--brand-3));
      -webkit-background-clip: text; background-clip: text; color: transparent;
    }
    .container-page{ max-width: 1200px; }
    .card{
      border:0; border-radius: 1rem;
      box-shadow: 0 8px 28px rgba(20,20,43,.08);
    }
    .card-plain{ box-shadow:none; border:1px solid #eef2f7; }
    .section-title{ font-weight:800; letter-spacing:.2px; }
    .muted{ color:#6c757d; }
    .stat{ display:flex; align-items:center; gap:12px; }
    .stat .icon{
      width:44px; height:44px; border-radius:12px;
      display:flex; align-items:center; justify-content:center; font-size:1.25rem;
      background:linear-gradient(135deg, var(--brand-2), var(--brand-3)); color:#fff;
      box-shadow: 0 10px 18px rgba(78,0,224,.25);
    }
    .stat .value{ font-size:2rem; font-weight:800; line-height:1; }
    .soft-badge{
      background: rgba(108,99,255,.12);
      color: var(--brand);
      border-radius: 1rem; padding:.35rem .6rem; font-weight:600;
    }
    .table thead th{
      text-transform:uppercase; letter-spacing:.06em; font-size:.8rem; color:#6c757d;
      border-bottom:1px solid #eef2f7;
    }
    .btn-gradient{
      background: linear-gradient(135deg, var(--brand-2), var(--brand-3)); color:#fff; border:none;
      box-shadow: 0 10px 20px rgba(78,0,224,.25);
    }
    .btn-gradient:hover{ filter:brightness(1.03); }
    .empty{
      border:1px dashed #dfe3eb; border-radius:1rem; padding:2rem; color:#6c757d;
      background: #fff;
    }
  </style>

  @stack('head')
</head>
<body>

<nav class="navbar navbar-expand-lg bg-white shadow-sm mb-4">
  <div class="container container-page">
    <a class="navbar-brand" href="{{ url('/') }}">
      {{ config('app.name', 'GrandpaCare') }}
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMain">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav ms-auto align-items-center">
        @auth
          <li class="nav-item me-2"><a href="{{ route('home') }}" class="nav-link">Inicio</a></li>
          <li class="nav-item me-2"><a href="{{ route('citas.index') }}" class="nav-link">Citas</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-semibold" href="#" data-bs-toggle="dropdown">
              <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <form method="POST" action="{{ route('logout') }}" class="px-3 py-2">
                  @csrf
                  <button class="btn btn-outline-danger w-100"><i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión</button>
                </form>
              </li>
            </ul>
          </li>
        @else
          <li class="nav-item me-2"><a href="{{ route('login') }}" class="btn btn-outline-primary">Iniciar sesión</a></li>
          <li class="nav-item me-2"><a href="{{ route('register') }}" class="btn btn-outline-success">Registrarse</a></li>
        @endauth
      </ul>
    </div>
  </div>
</nav>

<main class="container container-page mb-5">
  @yield('content')
</main>

{{-- Toasts (éxito/alertas) --}}
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
  @if(session('success'))
    <div class="toast show align-items-center text-bg-success border-0" role="alert">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif
  @if($errors->any())
    <div class="toast show align-items-center text-bg-danger border-0" role="alert">
      <div class="d-flex">
        <div class="toast-body">
          <i class="bi bi-exclamation-triangle me-2"></i>Corrige los errores del formulario.
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
      </div>
    </div>
  @endif
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
