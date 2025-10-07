<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Chocoart - Arte con chocolate. Productos artesanales y cursos de chocolatería profesional.">
    <meta name="keywords" content="chocolate, chocolatería, cursos, bombones, artesanal, Bogotá, Colombia">
    <title>@yield('title', 'Chocoart - Arte con chocolate')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@400;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
      :root { --brand-pink:#F055A5; }
      body { font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, 'Quicksand', sans-serif; }
    </style>
</head>
<body class="text-slate-800 antialiased">
    <!-- Top Bar -->
    <div class="bg-slate-900 text-slate-100 text-sm">
      <div class="container-choco">
        <div class="flex items-center justify-between py-2 gap-4">
          <div class="flex items-center gap-4">
            <span class="flex items-center gap-1">✉️ <span>info@chocoart.com.co</span></span>
            <span class="hidden sm:inline-flex items-center gap-1">📞 <span>+57 300 123 4567</span></span>
          </div>
          <div class="flex items-center gap-3">
            <a href="#" aria-label="Facebook" class="btn-link">
              <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            <a href="#" aria-label="Instagram" class="btn-link">
              <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/></svg>
            </a>
            <a href="#" aria-label="WhatsApp" class="btn-link">
              <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Navigation -->
    <nav class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-slate-200">
      <div class="container-choco">
        <div class="flex items-center justify-between py-3">
          <div class="shrink-0">
            <a href="{{ url('/') }}" class="inline-flex items-center">
              <img src="{{ asset('images/PRINCIPAL EXTENDIDO.png') }}" alt="Chocoart" class="h-10 w-auto">
            </a>
          </div>

          <button id="menuToggle" class="lg:hidden inline-flex flex-col gap-1.5 p-2 rounded-md border border-slate-200 hover:bg-slate-50" aria-label="Abrir menú" aria-expanded="false">
            <span class="block w-6 h-0.5 bg-slate-800"></span>
            <span class="block w-6 h-0.5 bg-slate-800"></span>
            <span class="block w-6 h-0.5 bg-slate-800"></span>
          </button>

          <ul id="mainMenu" class="hidden lg:flex items-center gap-6 font-medium">
            <li><a class="btn-link" href="{{ url('/') }}#inicio">Inicio</a></li>
            <li><a class="btn-link" href="{{ url('/') }}#productos">Productos</a></li>
            <li><a class="btn-link" href="{{ url('/') }}#cursos">Cursos</a></li>
            <li><a class="btn-link" href="{{ url('/') }}#galeria">Galería</a></li>
            <li><a class="btn-link" href="{{ url('/') }}#contacto">Contacto</a></li>
          </ul>
        </div>

        <!-- Menú móvil -->
        <div id="mobileMenu" class="hidden lg:hidden pb-4">
          <ul class="flex flex-col gap-2 text-base">
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600" href="{{ url('/') }}#inicio">Inicio</a></li>
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600" href="{{ url('/') }}#productos">Productos</a></li>
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600" href="{{ url('/') }}#cursos">Cursos</a></li>
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600" href="{{ url('/') }}#galeria">Galería</a></li>
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600" href="{{ url('/') }}#contacto">Contacto</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="">
      @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-50 border-t border-slate-200 mt-16">
      <div class="container-choco">
        <div class="grid gap-10 lg:grid-cols-4 py-12">
          <div class="col-span-1">
            <img src="{{ asset('images/PRINCIPAL EXTENDIDO.png') }}" alt="Chocoart" class="h-12 w-auto">
            <p class="mt-3 text-slate-600">Arte con chocolate</p>
            <div class="mt-4 flex items-center gap-3">
              <a href="#" aria-label="Facebook" class="btn-link">
                <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
              </a>
              <a href="#" aria-label="Instagram" class="btn-link">
                <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/></svg>
              </a>
              <a href="#" aria-label="WhatsApp" class="btn-link">
                <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
              </a>
            </div>
          </div>

          <div class="grid grid-cols-2 gap-8 lg:col-span-3">
            <div>
              <h4 class="text-slate-900 font-semibold mb-3">Productos</h4>
              <ul class="space-y-2 text-slate-600">
                <li><a class="btn-link" href="{{ url('/') }}#productos">Bombones</a></li>
                <li><a class="btn-link" href="{{ url('/') }}#productos">Tabletas</a></li>
                <li><a class="btn-link" href="{{ url('/') }}#productos">Figuras</a></li>
                <li><a class="btn-link" href="{{ url('/') }}#productos">Trufas</a></li>
              </ul>
            </div>
            <div>
              <h4 class="text-slate-900 font-semibold mb-3">Academia</h4>
              <ul class="space-y-2 text-slate-600">
                <li><a class="btn-link" href="{{ url('/') }}#cursos">Curso Básico</a></li>
                <li><a class="btn-link" href="{{ url('/') }}#cursos">Curso Avanzado</a></li>
                <li><a class="btn-link" href="{{ url('/') }}#cursos">Masterclass</a></li>
                <li><a class="btn-link" href="{{ url('/') }}#cursos">Corporativo</a></li>
              </ul>
            </div>
            <div>
              <h4 class="text-slate-900 font-semibold mb-3">Información</h4>
              <ul class="space-y-2 text-slate-600">
                <li><a class="btn-link" href="{{ url('/') }}#inicio">Sobre Nosotros</a></li>
                <li><a class="btn-link" href="#">Blog</a></li>
                <li><a class="btn-link" href="#">FAQ</a></li>
                <li><a class="btn-link" href="{{ url('/') }}#contacto">Contacto</a></li>
              </ul>
            </div>
          </div>
        </div>

        <div class="py-6 border-t border-slate-200 text-center text-sm text-slate-600">
          &copy; {{ date('Y') }} Chocoart. Todos los derechos reservados. |
          <a href="https://chocoart.com.co" class="btn-link">Chocoart.com.co</a>
        </div>
      </div>
    </footer>

    @stack('scripts')

    <!-- Toggle del menú móvil (vanilla JS) -->
    <script>
      (function () {
        const toggle = document.getElementById('menuToggle');
        const mobile = document.getElementById('mobileMenu');
        const main = document.getElementById('mainMenu');

        if (!toggle || !mobile) return;

        toggle.addEventListener('click', () => {
          const isOpen = mobile.classList.toggle('hidden') === false;
          toggle.setAttribute('aria-expanded', String(isOpen));
        });
      })();
    </script>

    <!-- Animaciones temáticas de Chocoart -->
    <script src="{{ asset('js/animations.js') }}"></script>
</body>
</html>
