<!DOCTYPE html>
<html lang="es">
<head>
    @php
        use Illuminate\Support\Facades\Route;
        use Illuminate\Support\Facades\Storage;

        // Detecta la ruta actual y mapea a las páginas SEO permitidas
        $routeName = Route::currentRouteName();
        $allowed = [
            'home'      => 'home',
            'productos' => 'productos',
            'cursos'    => 'cursos',
            'galeria'   => 'galeria',
            'blog'      => 'blog',
            'contacto'  => 'contacto',
        ];
        $pageKey = $allowed[$routeName] ?? 'home';

        // SEO desde BD
        $seo = \App\Models\SeoSetting::forPage($pageKey);

        // Título preferente: yield('title') > meta_title (SEO) > fallback
        $yieldTitle = trim($__env->yieldContent('title') ?? '');
        $metaTitle  = $yieldTitle !== '' ? $yieldTitle : ($seo->meta_title ?? 'Chocoart - Arte con chocolate');

        // Descripción / keywords
        $metaDesc = $seo->meta_description
            ?? 'Chocoart - Arte con chocolate. Productos artesanales y cursos de chocolatería profesional.';
        $metaKeywords = $seo->meta_keywords
            ?? 'chocolate, chocolatería, cursos, bombones, artesanal, Bogotá, Colombia';

        // Open Graph / Social
        $ogTitle = $seo->og_title ?: $metaTitle;
        $ogDesc  = $seo->og_description ?: $metaDesc;
        $ogType  = $seo->og_type ?: 'website';

        // Imagen OG: usa accessor si existe, o resuelve ruta relativa del disk public, o fallback
        $ogImage = null;
        if ($seo && !empty($seo->og_image)) {
            if (method_exists($seo, 'getOgImageUrlAttribute') && $seo->og_image_url) {
                $ogImage = $seo->og_image_url;
            } else {
                $ogImage = str_starts_with($seo->og_image, ['http://','https://'])
                    ? $seo->og_image
                    : Storage::disk('public')->url($seo->og_image);
            }
        }
        $ogImage = $ogImage ?: asset('images/og-default.jpg');

        $currentUrl = url()->current();
    @endphp

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Favicon --}}
    <link rel="icon" type="image/png" href="{{ asset('images/PRINCIPAL.png') }}">
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/PRINCIPAL.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/PRINCIPAL.png') }}">

    {{-- Meta SEO básicas --}}
    <title>{{ $metaTitle }}</title>
    <meta name="description" content="{{ $metaDesc }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <link rel="canonical" href="{{ $currentUrl }}"/>

    {{-- Open Graph / Facebook --}}
    <meta property="og:title" content="{{ $ogTitle }}">
    <meta property="og:description" content="{{ $ogDesc }}">
    <meta property="og:type" content="{{ $ogType }}">
    <meta property="og:url" content="{{ $currentUrl }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:site_name" content="Chocoart">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $ogTitle }}">
    <meta name="twitter:description" content="{{ $ogDesc }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    {{-- JSON-LD / Schema (si existe en BD) --}}
    @if(!empty($seo?->schema_markup))
      <script type="application/ld+json">{!! $seo->schema_markup !!}</script>
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@400;700&family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <style>
      :root { --brand-pink:#F055A5; }
      body { font-family: 'Poppins', system-ui, -apple-system, Segoe UI, Roboto, 'Quicksand', sans-serif; }

      /* Animaciones personalizadas */
      @keyframes spin-slow { from { transform: rotate(0deg); } to { transform: rotate(360deg); } }
      .animate-spin-slow { animation: spin-slow 20s linear infinite; }

      @keyframes float { 0%, 100% { transform: translateY(0px); } 50% { transform: translateY(-20px); } }
      .animate-float { animation: float 3s ease-in-out infinite; }

      /* Contenedor personalizado */
      .container-choco { max-width: 1280px; margin-left: auto; margin-right: auto; padding-left: 1.5rem; padding-right: 1.5rem; }

      /* Navigation links with aqua underline hover */
      .nav-link { position: relative; transition: color 0.3s ease; }
      .nav-link::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background-color: #81cacf; transition: width 0.3s ease; }
      .nav-link:hover::after { width: 100%; }
      .nav-link:hover { color: #81cacf; }

      /* Estado activo: colorea y fuerza subrayado completo */
      .nav-link.active { color: #81cacf; }
      .nav-link.active::after { width: 100%; }

      /* WhatsApp Floating Button */
      .whatsapp-float {
        position: fixed; bottom: 25px; right: 25px; background-color: #25D366; color: white;
        width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
        box-shadow: 0 4px 12px rgba(37, 211, 102, 0.4); transition: all 0.3s ease; z-index: 1000; text-decoration: none;
      }
      .whatsapp-float:hover { background-color: #128C7E; transform: scale(1.1); box-shadow: 0 6px 20px rgba(37, 211, 102, 0.6); }
      .whatsapp-float svg { width: 32px; height: 32px; }
    </style>
</head>
<body class="text-slate-800 antialiased">
    <!-- Top Bar -->
    <div class="bg-slate-900 text-slate-100 text-sm">
      <div class="container-choco">
        <div class="flex items-center justify-between py-2 gap-4">
          <div class="flex items-center gap-4">
            <span class="flex items-center gap-1">✉️ <span>{{ \App\Models\Setting::get('contact_email', 'info@chocoart.com.co') }}</span></span>
            <span class="hidden sm:inline-flex items-center gap-1">📞 <span>{{ \App\Models\Setting::get('contact_phone', '+57 300 123 4567') }}</span></span>
          </div>
          <div class="flex items-center gap-3">
            @if(\App\Models\Setting::get('social_facebook'))
            <a href="{{ \App\Models\Setting::get('social_facebook') }}" aria-label="Facebook" class="btn-link" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
            </a>
            @endif
            @if(\App\Models\Setting::get('social_instagram'))
            <a href="{{ \App\Models\Setting::get('social_instagram') }}" aria-label="Instagram" class="btn-link" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/></svg>
            </a>
            @endif
            @if(\App\Models\Setting::get('contact_whatsapp'))
            <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '573001234567') }}" aria-label="WhatsApp" class="btn-link" target="_blank" rel="noopener">
              <svg viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
            </a>
            @endif
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
              <img src="{{ asset('images/PRINCIPAL.png') }}"
                   alt="Chocoart"
                   class="h-14 md:h-14 w-auto scale-200 transform origin-center">
            </a>
          </div>

          <button id="menuToggle" class="lg:hidden inline-flex flex-col gap-1.5 p-2 rounded-md border border-slate-200 hover:bg-slate-50" aria-label="Abrir menú" aria-expanded="false">
            <span class="block w-6 h-0.5 bg-slate-800"></span>
            <span class="block w-6 h-0.5 bg-slate-800"></span>
            <span class="block w-6 h-0.5 bg-slate-800"></span>
          </button>

          <ul id="mainMenu" class="hidden lg:flex items-center gap-6 font-medium">
            <li>
              <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                 href="{{ route('home') }}"
                 aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}">
                 Inicio
              </a>
            </li>
            <li>
              <a class="nav-link {{ request()->routeIs('productos') ? 'active' : '' }}"
                 href="{{ route('productos') }}"
                 aria-current="{{ request()->routeIs('productos') ? 'page' : 'false' }}">
                 Productos
              </a>
            </li>
            <li>
              <a class="nav-link {{ request()->routeIs('cursos') ? 'active' : '' }}"
                 href="{{ route('cursos') }}"
                 aria-current="{{ request()->routeIs('cursos') ? 'page' : 'false' }}">
                 Cursos
              </a>
            </li>
            <li>
              <a class="nav-link {{ request()->routeIs('galeria') ? 'active' : '' }}"
                 href="{{ route('galeria') }}"
                 aria-current="{{ request()->routeIs('galeria') ? 'page' : 'false' }}">
                 Galería
              </a>
            </li>
            <li>
              <a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}"
                 href="{{ route('blog') }}"
                 aria-current="{{ request()->routeIs('blog') ? 'page' : 'false' }}">
                 Blog
              </a>
            </li>
            <li>
              <a class="nav-link {{ request()->routeIs('contacto') ? 'active' : '' }}"
                 href="{{ route('contacto') }}"
                 aria-current="{{ request()->routeIs('contacto') ? 'page' : 'false' }}">
                 Contacto
              </a>
            </li>
          </ul>
        </div>

        <!-- Menú móvil -->
        <div id="mobileMenu" class="hidden lg:hidden pb-4">
          <ul class="flex flex-col gap-2 text-base">
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600 {{ request()->routeIs('home') ? 'bg-pink-50 text-pink-600' : '' }}" href="{{ route('home') }}" aria-current="{{ request()->routeIs('home') ? 'page' : 'false' }}">Inicio</a></li>
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600 {{ request()->routeIs('productos') ? 'bg-pink-50 text-pink-600' : '' }}" href="{{ route('productos') }}" aria-current="{{ request()->routeIs('productos') ? 'page' : 'false' }}">Productos</a></li>
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600 {{ request()->routeIs('cursos') ? 'bg-pink-50 text-pink-600' : '' }}" href="{{ route('cursos') }}" aria-current="{{ request()->routeIs('cursos') ? 'page' : 'false' }}">Cursos</a></li>
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600 {{ request()->routeIs('galeria') ? 'bg-pink-50 text-pink-600' : '' }}" href="{{ route('galeria') }}" aria-current="{{ request()->routeIs('galeria') ? 'page' : 'false' }}">Galería</a></li>
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600 {{ request()->routeIs('blog') ? 'bg-pink-50 text-pink-600' : '' }}" href="{{ route('blog') }}" aria-current="{{ request()->routeIs('blog') ? 'page' : 'false' }}">Blog</a></li>
            <li><a class="block px-3 py-2 rounded-md hover:bg-pink-50 hover:text-pink-600 {{ request()->routeIs('contacto') ? 'bg-pink-50 text-pink-600' : '' }}" href="{{ route('contacto') }}" aria-current="{{ request()->routeIs('contacto') ? 'page' : 'false' }}">Contacto</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="">
      @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative bg-gradient-to-br from-pink-50 via-blue-50 to-lime-50 mt-20">
      <!-- Wave Divider Top - Mobile (sutiles) -->
      <div class="lg:hidden absolute top-0 left-0 w-full overflow-hidden">
        <svg class="w-full h-20 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
          <path d="M0,60 Q50,20 100,60 T200,60 T300,60 T400,60 T500,60 T600,60 T700,60 T800,60 T900,60 T1000,60 T1100,60 T1200,60 L1200,0 L0,0 Z" class="fill-white"></path>
        </svg>
      </div>

      <!-- Wave Divider Top - Desktop (pronunciadas) -->
      <div class="hidden lg:block absolute top-0 left-0 w-full overflow-hidden">
        <svg class="w-full h-16 md:h-20" viewBox="0 0 1200 60" preserveAspectRatio="none">
          <path d="M0,30 Q15,0 30,30 T60,30 T90,30 T120,30 T150,30 T180,30 T210,30 T240,30 T270,30 T300,30 T330,30 T360,30 T390,30 T420,30 T450,30 T480,30 T510,30 T540,30 T570,30 T600,30 T630,30 T660,30 T690,30 T720,30 T750,30 T780,30 T810,30 T840,30 T870,30 T900,30 T930,30 T960,30 T990,30 T1020,30 T1050,30 T1080,30 T1110,30 T1140,30 T1170,30 T1200,30 L1200,0 L0,0 Z" class="fill-white"></path>
        </svg>
      </div>

      <div class="container-choco pt-20">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-4 py-12">
          <!-- Columna 1: Logo y Redes Sociales -->
          <div>
            @php
              $footerLogo = \App\Models\Setting::get('footer_logo', 'images/PRINCIPAL.png');
              $logoPath = str_starts_with($footerLogo, 'settings/') ? asset('storage/' . $footerLogo) : asset($footerLogo);
            @endphp
            <img src="{{ $logoPath }}" alt="Chocoart" class="h-20 w-auto mb-4">
            <p class="text-[#5f3917] font-['Dancing_Script'] text-xl mb-4">{{ \App\Models\Setting::get('footer_about', 'Arte dulce con amor') }}</p>
            <div class="flex items-center gap-3">
              @if(\App\Models\Setting::get('social_facebook'))
              <a href="{{ \App\Models\Setting::get('social_facebook') }}" aria-label="Facebook" class="w-10 h-10 rounded-full bg-white shadow-md hover:shadow-lg flex items-center justify-center text-[#e28dc4] hover:bg-[#e28dc4] hover:text-white transition-all duration-300" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
              </a>
              @endif
              @if(\App\Models\Setting::get('social_instagram'))
              <a href="{{ \App\Models\Setting::get('social_instagram') }}" aria-label="Instagram" class="w-10 h-10 rounded-full bg-white shadow-md hover:shadow-lg flex items-center justify-center text-[#81cacf] hover:bg-[#81cacf] hover:text-white transition-all duration-300" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/></svg>
              </a>
              @endif
              @if(\App\Models\Setting::get('contact_whatsapp'))
              <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '573001234567') }}" aria-label="WhatsApp" class="w-10 h-10 rounded-full bg-white shadow-md hover:shadow-lg flex items-center justify-center text-[#c6d379] hover:bg-[#c6d379] hover:text-white transition-all duration-300" target="_blank" rel="noopener">
                <svg viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
              </a>
              @endif
            </div>
          </div>

          <!-- Columna 2: Productos -->
          <div>
            <h4 class="text-[#5f3917] font-bold mb-4 text-lg">Productos</h4>
            <ul class="space-y-3 text-gray-600">
              @if(isset($footerProducts) && $footerProducts->count() > 0)
                @foreach($footerProducts as $product)
                  <li>
                    <a class="hover:text-[#e28dc4] transition-colors inline-flex items-center gap-2" href="{{ route('productos') }}">
                      @if($product->icon)
                        <span class="text-sm">{{ $product->icon }}</span>
                      @endif
                      {{ $product->name }}
                    </a>
                  </li>
                @endforeach
              @else
                <li><a class="hover:text-[#e28dc4] transition-colors" href="{{ route('productos') }}">Ver todos</a></li>
              @endif
            </ul>
          </div>

          <!-- Columna 3: Academia -->
          <div>
            <h4 class="text-[#5f3917] font-bold mb-4 text-lg">Academia</h4>
            <ul class="space-y-3 text-gray-600">
              @if(isset($footerCourses) && $footerCourses->count() > 0)
                @foreach($footerCourses as $course)
                  <li><a class="hover:text-[#81cacf] transition-colors" href="{{ route('cursos') }}">{{ $course->title }}</a></li>
                @endforeach
              @else
                <li><a class="hover:text-[#81cacf] transition-colors" href="{{ route('cursos') }}">Ver todos</a></li>
              @endif
            </ul>
          </div>

          <!-- Columna 4: Información -->
          <div>
            <h4 class="text-[#5f3917] font-bold mb-4 text-lg">Información</h4>
            <ul class="space-y-3 text-gray-600">
              <li><a class="hover:text-[#c6d379] transition-colors" href="{{ route('home') }}">Inicio</a></li>
              <li><a class="hover:text-[#c6d379] transition-colors" href="{{ route('productos') }}">Productos</a></li>
              <li><a class="hover:text-[#c6d379] transition-colors" href="{{ route('cursos') }}">Cursos</a></li>
              <li><a class="hover:text-[#c6d379] transition-colors" href="{{ route('galeria') }}">Galería</a></li>
              <li><a class="hover:text-[#c6d379] transition-colors" href="{{ route('blog') }}">Blog</a></li>
              <li><a class="hover:text-[#c6d379] transition-colors" href="{{ route('contacto') }}">Contacto</a></li>
            </ul>
          </div>
        </div>

        <div class="py-6 border-t border-pink-200 text-center text-sm text-gray-600">
          <p class="mb-2">{{ \App\Models\Setting::get('footer_copyright', '© ' . date('Y') . ' Chocoart - Todos los derechos reservados') }}</p>
          <p class="text-xs">Hecho con <span class="text-red-500">❤️</span> y mucho <span class="text-[#5f3917]">🍫</span></p>
        </div>
      </div>
    </footer>

    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/{{ \App\Models\Setting::get('contact_whatsapp', '573001234567') }}?text={{ urlencode(\App\Models\Setting::get('contact_whatsapp_message', 'Hola, me gustaría obtener más información')) }}" target="_blank" class="whatsapp-float" aria-label="Contactar por WhatsApp">
      <svg fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
      </svg>
    </a>

    @stack('scripts')

    <!-- Toggle del menú móvil (vanilla JS) -->
    <script>
      (function () {
        const toggle = document.getElementById('menuToggle');
        const mobile = document.getElementById('mobileMenu');

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
