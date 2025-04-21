<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo', 'Loja de Eletrônicos')</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-..." crossorigin="anonymous">
</head>

<body class="bg-light">

  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ url('/') }}">
        Loja Caçador
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          {{-- Links para visitantes --}}
          @guest
        <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="{{ route('register') }}">Registrar</a>
        </li>
      @else

      @if(Auth::user()->is_admin)
      <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="adminMenu" role="button" data-bs-toggle="dropdown"
      aria-expanded="false">
      Administração
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminMenu">
      {{-- <li><a class="dropdown-item" href="{{ route('categorias.index') }}">Categorias</a></li>
      <li><a class="dropdown-item" href="{{ route('produtos.index') }}">Produtos</a></li>
      <li><a class="dropdown-item" href="{{ route('fotos.index') }}">Fotos de Produtos</a></li> --}}
      <li><a class="dropdown-item" href="{{ route('cidades.index') }}">Cidades</a></li>
      </ul>
      </li>
    @endif


      <li class="nav-item dropdown">
      <a id="userDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
        aria-expanded="false">
        {{ Auth::user()->name }}
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
        <li>
        <a class="dropdown-item" href="#"
          onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          Sair
        </a>
        </li>
      </ul>
      </li>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
      @csrf
      </form>
    @endguest
        </ul>
      </div>
    </div>
  </nav>

  <div class="container py-5">
    @yield('conteudo')
  </div>

  <footer class="bg-white text-center py-3 shadow-sm">
    <div class="container">
      &copy; {{ date('Y') }} Loja de Eletrônicos – Caçador
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-..."
    crossorigin="anonymous"></script>
</body>

</html>