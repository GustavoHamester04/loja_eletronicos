<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('titulo', 'Loja de Eletrônicos')</title>
  <!-- Bootstrap (CDN) -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

  {{-- Navbar comum --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}">Loja Caçador</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
              data-bs-target="#navbarNav" aria-controls="navbarNav"
              aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          {{-- Aqui você pode colocar links de categorias, login, carrinho, etc. --}}
        </ul>
      </div>
    </div>
  </nav>

  {{-- Área principal --}}
  <div class="container py-5">
    @yield('conteudo')
  </div>

  {{-- Footer simples --}}
  <footer class="bg-white text-center py-3 shadow-sm">
    <div class="container">
      &copy; {{ date('Y') }} Loja de Eletrônicos – Caçador
    </div>
  </footer>

  <!-- Scripts Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
