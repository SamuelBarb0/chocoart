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

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @stack('styles')
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <div class="nav-wrapper">
                <div class="logo">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('images/PRINCIPAL EXTENDIDO.png') }}" alt="Chocoart" class="logo-img">
                    </a>
                </div>
                <ul class="nav-menu">
                    <li><a href="{{ url('/') }}#inicio">Inicio</a></li>
                    <li><a href="{{ url('/') }}#productos">Productos</a></li>
                    <li><a href="{{ url('/') }}#cursos">Cursos</a></li>
                    <li><a href="{{ url('/') }}#galeria">Galería</a></li>
                    <li><a href="{{ url('/') }}#contacto">Contacto</a></li>
                </ul>
                <button class="menu-toggle" aria-label="Toggle menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-brand">
                    <img src="{{ asset('images/PRINCIPAL EXTENDIDO.png') }}" alt="Chocoart" class="footer-logo">
                    <p class="footer-slogan">Arte con chocolate</p>
                    <div class="social-links">
                        <a href="#" aria-label="Facebook" target="_blank">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" aria-label="Instagram" target="_blank">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" aria-label="WhatsApp" target="_blank">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="footer-links">
                    <div class="footer-column">
                        <h4>Productos</h4>
                        <ul>
                            <li><a href="{{ url('/') }}#productos">Bombones</a></li>
                            <li><a href="{{ url('/') }}#productos">Tabletas</a></li>
                            <li><a href="{{ url('/') }}#productos">Figuras</a></li>
                            <li><a href="{{ url('/') }}#productos">Trufas</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Academia</h4>
                        <ul>
                            <li><a href="{{ url('/') }}#cursos">Curso Básico</a></li>
                            <li><a href="{{ url('/') }}#cursos">Curso Avanzado</a></li>
                            <li><a href="{{ url('/') }}#cursos">Masterclass</a></li>
                            <li><a href="{{ url('/') }}#cursos">Corporativo</a></li>
                        </ul>
                    </div>
                    <div class="footer-column">
                        <h4>Información</h4>
                        <ul>
                            <li><a href="{{ url('/') }}#inicio">Sobre Nosotros</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">FAQ</a></li>
                            <li><a href="{{ url('/') }}#contacto">Contacto</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} Chocoart. Todos los derechos reservados. | <a href="https://chocoart.com.co">Chocoart.com.co</a></p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('js/script.js') }}"></script>

    @stack('scripts')
</body>
</html>
