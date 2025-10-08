@extends('layouts.app')

@section('title', 'Chocoart - Arte con chocolate | Inicio')

@section('content')

<!-- Hero Banner Section -->
<section id="inicio" class="relative overflow-hidden bg-gradient-to-br from-[#3d2817] via-[#5f3917] to-[#3d2817]">
  <!-- Fondo en video -->
  <video
    class="absolute inset-0 w-full h-full object-cover opacity-30 pointer-events-none"
    src="{{ asset('videos/Prueba.mp4') }}"
    autoplay muted loop playsinline preload="metadata"></video>

  <!-- Overlay oscuro -->
  <div class="absolute inset-0 bg-gradient-to-br from-black/50 via-transparent to-black/30"></div>

  <!-- Hero Content -->
  <div class="relative z-10 container-choco py-24 md:py-32 lg:py-40">
    <div class="max-w-4xl mx-auto text-center">

      <!-- Logo -->
      <div class="relative mx-auto mb-8">
        <div class="relative mx-auto h-40 md:h-52 lg:h-64 w-auto">
          <img
            src="{{ asset('images/LC_1Logo ChocoArt.png') }}"
            alt="Chocoart"
            class="hero-logo absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2
                   h-[150%] md:h-[160%] lg:h-[185%] w-auto
                   drop-shadow-2xl will-change-transform" />
        </div>
      </div>

      <!-- Slogan -->
      <h1 class="font-['Dancing_Script'] text-4xl md:text-5xl lg:text-6xl text-[#e28dc4] mb-6 drop-shadow-lg">
        Arte con Chocolate
      </h1>

      <!-- Description -->
      <p class="text-xl md:text-2xl text-white/90 mb-4 max-w-3xl mx-auto leading-relaxed">
        Creaciones artesanales que despiertan tus sentidos
      </p>

      <p class="text-base md:text-lg text-white/75 mb-12 max-w-2xl mx-auto">
        Cada pieza de chocolate es una obra de arte elaborada con pasión, dedicación y los mejores ingredientes premium
      </p>

      <!-- CTA Buttons -->
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="{{ route('productos') }}"
           class="group px-8 py-4 bg-white text-[#5f3917] rounded-full font-semibold hover:bg-[#e28dc4] hover:text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl inline-flex items-center gap-2">
          Explorar Productos
          <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
          </svg>
        </a>
        <a href="{{ route('cursos') }}"
           class="px-8 py-4 bg-transparent text-white border-2 border-white rounded-full font-semibold hover:bg-white hover:text-[#5f3917] transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">
          Ver Cursos
        </a>
      </div>
    </div>
  </div>

  <!-- Wave Divider Bottom -->
  <div class="absolute -bottom-1 left-0 w-full z-10">
    <svg class="w-full h-16 md:h-20" viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,30 Q15,0 30,30 T60,30 T90,30 T120,30 T150,30 T180,30 T210,30 T240,30 T270,30 T300,30 T330,30 T360,30 T390,30 T420,30 T450,30 T480,30 T510,30 T540,30 T570,30 T600,30 T630,30 T660,30 T690,30 T720,30 T750,30 T780,30 T810,30 T840,30 T870,30 T900,30 T930,30 T960,30 T990,30 T1020,30 T1050,30 T1080,30 T1110,30 T1140,30 T1170,30 T1200,30 L1200,60 L0,60 Z" fill="white"/>
    </svg>
  </div>

  <style>
    @media (max-width: 640px) {
      .hero-logo {
        height: 180% !important;
      }
    }
  </style>
</section>

<!-- Nosotros Section -->
<section class="py-16 md:py-20 bg-white">
  <div class="container-choco">
    <div class="max-w-4xl mx-auto text-center mb-12">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-['Dancing_Script'] text-[#5f3917] mb-6">
        Sobre Nosotros
      </h2>
      <p class="text-lg md:text-xl text-gray-700 leading-relaxed mb-6">
        En <span class="font-semibold text-[#e28dc4]">Chocoart</span>, transformamos el chocolate en verdaderas obras de arte.
        Cada pieza que creamos es el resultado de años de pasión, dedicación y perfeccionamiento de técnicas artesanales.
      </p>
      <p class="text-base md:text-lg text-gray-600 leading-relaxed">
        Creemos que el chocolate es más que un simple dulce: es una experiencia sensorial que conecta emociones y crea momentos memorables.
        Nuestro compromiso es utilizar solo ingredientes premium y trabajar con chocolate de origen sostenible.
      </p>
    </div>

    <!-- Features Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">

      <!-- Feature 1 -->
      <div class="text-center group">
        <div class="w-20 h-20 mx-auto mb-4 relative">
          <div class="absolute inset-0 rounded-full bg-[#e28dc4] text-white flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path d="M12 2L2 7l10 5 10-5-10-5z"></path>
              <path d="M2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-semibold text-[#5f3917] mb-2">100% Artesanal</h3>
        <p class="text-gray-600">Cada pieza elaborada con dedicación y amor por el chocolate</p>
      </div>

      <!-- Feature 2 -->
      <div class="text-center group">
        <div class="w-20 h-20 mx-auto mb-4 relative">
          <div class="absolute inset-0 rounded-full bg-[#81cacf] text-white flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-semibold text-[#5f3917] mb-2">Ingredientes Premium</h3>
        <p class="text-gray-600">Solo los mejores ingredientes para nuestras creaciones</p>
      </div>

      <!-- Feature 3 -->
      <div class="text-center group">
        <div class="w-20 h-20 mx-auto mb-4 relative">
          <div class="absolute inset-0 rounded-full bg-[#c6d379] text-white flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
          </div>
        </div>
        <h3 class="text-xl font-semibold text-[#5f3917] mb-2">Academia</h3>
        <p class="text-gray-600">Aprende las técnicas profesionales de chocolatería</p>
      </div>

    </div>
  </div>
</section>

<!-- Productos Preview Section -->
<section class="relative py-20 bg-gradient-to-b from-white to-pink-50">
  <!-- Wave divider top -->
  <div class="absolute -top-1 left-0 w-full overflow-hidden leading-none rotate-180">
    <svg class="relative block w-full h-16 md:h-20" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="white"></path>
    </svg>
  </div>

  <div class="container-choco pt-12">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-['Dancing_Script'] text-[#e28dc4] mb-4">
        Nuestros Productos
      </h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-8">
        Descubre nuestra selección de chocolates artesanales, bombones, tabletas y figuras personalizadas
      </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 md:gap-8 max-w-5xl mx-auto mb-12">

      <!-- Producto 1 -->
      <div class="group relative">
        <div class="relative w-full aspect-square mb-4">
          <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-[#e28dc4] to-[#81cacf] flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
            <div class="text-6xl transform group-hover:scale-110 transition-transform duration-300">🍫</div>
          </div>
        </div>
        <h3 class="text-lg font-semibold text-[#5f3917] text-center">Bombones</h3>
      </div>

      <!-- Producto 2 -->
      <div class="group relative">
        <div class="relative w-full aspect-square mb-4">
          <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-[#81cacf] to-[#c6d379] flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
            <div class="text-6xl transform group-hover:scale-110 transition-transform duration-300">🍫</div>
          </div>
        </div>
        <h3 class="text-lg font-semibold text-[#5f3917] text-center">Tabletas</h3>
      </div>

      <!-- Producto 3 -->
      <div class="group relative">
        <div class="relative w-full aspect-square mb-4">
          <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-[#c6d379] to-[#e28dc4] flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
            <div class="text-6xl transform group-hover:scale-110 transition-transform duration-300">🎁</div>
          </div>
        </div>
        <h3 class="text-lg font-semibold text-[#5f3917] text-center">Figuras</h3>
      </div>

      <!-- Producto 4 -->
      <div class="group relative">
        <div class="relative w-full aspect-square mb-4">
          <div class="absolute inset-0 rounded-2xl bg-gradient-to-br from-[#5f3917] to-[#e28dc4] flex items-center justify-center shadow-lg group-hover:shadow-xl transition-shadow duration-300">
            <div class="text-6xl transform group-hover:scale-110 transition-transform duration-300">🍬</div>
          </div>
        </div>
        <h3 class="text-lg font-semibold text-[#5f3917] text-center">Trufas</h3>
      </div>

    </div>

    <div class="text-center">
      <a href="{{ route('productos') }}" class="inline-block px-8 py-4 bg-[#5f3917] text-white rounded-full font-semibold hover:bg-[#e28dc4] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
        Ver Todos los Productos
      </a>
    </div>
  </div>
</section>

<!-- Cursos Preview Section -->
<section class="relative py-20 bg-gradient-to-b from-[#81cacf] to-[#c6d379] overflow-hidden">
  <!-- Scalloped border top -->
  <div class="absolute -top-1 left-0 w-full z-10">
    <svg class="w-full h-16" viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,30 Q15,60 30,30 T60,30 T90,30 T120,30 T150,30 T180,30 T210,30 T240,30 T270,30 T300,30 T330,30 T360,30 T390,30 T420,30 T450,30 T480,30 T510,30 T540,30 T570,30 T600,30 T630,30 T660,30 T690,30 T720,30 T750,30 T780,30 T810,30 T840,30 T870,30 T900,30 T930,30 T960,30 T990,30 T1020,30 T1050,30 T1080,30 T1110,30 T1140,30 T1170,30 T1200,30 L1200,0 L0,0 Z" fill="#fdf2f8" />
    </svg>
  </div>

  <!-- Pattern overlay -->
  <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/svg%3E');"></div>

  <div class="container-choco relative z-10">
    <div class="text-center mb-12 text-white">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-['Dancing_Script'] mb-4">
        Academia Chocoart
      </h2>
      <p class="text-lg md:text-xl max-w-3xl mx-auto mb-8 leading-relaxed">
        Aprende el arte de la chocolatería profesional con nuestros cursos especializados.
        Desde técnicas básicas hasta masterclasses avanzadas.
      </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto mb-12">

      <!-- Curso 1 -->
      <div class="bg-white/95 backdrop-blur-sm p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
        <div class="w-16 h-16 mx-auto mb-4 bg-[#e28dc4] rounded-full flex items-center justify-center">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#5f3917] mb-2 text-center">Curso Básico</h3>
        <p class="text-gray-600 text-center text-sm">Fundamentos de la chocolatería artesanal</p>
      </div>

      <!-- Curso 2 -->
      <div class="bg-white/95 backdrop-blur-sm p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
        <div class="w-16 h-16 mx-auto mb-4 bg-[#81cacf] rounded-full flex items-center justify-center">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path d="M13 10V3L4 14h7v7l9-11h-7z"></path>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#5f3917] mb-2 text-center">Curso Avanzado</h3>
        <p class="text-gray-600 text-center text-sm">Técnicas profesionales y decoración</p>
      </div>

      <!-- Curso 3 -->
      <div class="bg-white/95 backdrop-blur-sm p-6 rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300">
        <div class="w-16 h-16 mx-auto mb-4 bg-[#c6d379] rounded-full flex items-center justify-center">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
            <path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-[#5f3917] mb-2 text-center">Masterclass</h3>
        <p class="text-gray-600 text-center text-sm">Bombones rellenos gourmet</p>
      </div>

    </div>

    <div class="text-center">
      <a href="{{ route('cursos') }}" class="inline-block px-8 py-4 bg-white text-[#5f3917] rounded-full font-semibold hover:bg-[#5f3917] hover:text-white transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
        Explorar Cursos
      </a>
    </div>
  </div>

  <!-- Scalloped border bottom -->
  <div class="absolute -bottom-1 left-0 w-full z-10">
    <svg class="w-full h-16" viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,30 Q15,0 30,30 T60,30 T90,30 T120,30 T150,30 T180,30 T210,30 T240,30 T270,30 T300,30 T330,30 T360,30 T390,30 T420,30 T450,30 T480,30 T510,30 T540,30 T570,30 T600,30 T630,30 T660,30 T690,30 T720,30 T750,30 T780,30 T810,30 T840,30 T870,30 T900,30 T930,30 T960,30 T990,30 T1020,30 T1050,30 T1080,30 T1110,30 T1140,30 T1170,30 T1200,30 L1200,60 L0,60 Z" fill="white" />
    </svg>
  </div>
</section>

<!-- Galería Preview Section -->
<section class="py-20 bg-white">
  <div class="container-choco">
    <div class="text-center mb-12">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-['Dancing_Script'] text-[#e28dc4] mb-4">
        Galería de Creaciones
      </h2>
      <p class="text-lg text-gray-600 max-w-2xl mx-auto">
        Un vistazo a nuestras obras de arte comestibles
      </p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-6xl mx-auto mb-12">

      <div class="relative group overflow-hidden rounded-2xl shadow-lg h-48 md:h-64 cursor-pointer">
        <div class="absolute inset-0 bg-gradient-to-br from-[#e28dc4] to-[#81cacf]"></div>
        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold">Bombones</h4>
        </div>
      </div>

      <div class="relative group overflow-hidden rounded-2xl shadow-lg h-48 md:h-64 cursor-pointer">
        <div class="absolute inset-0 bg-gradient-to-br from-[#81cacf] to-[#c6d379]"></div>
        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold">Tabletas</h4>
        </div>
      </div>

      <div class="relative group overflow-hidden rounded-2xl shadow-lg h-48 md:h-64 cursor-pointer">
        <div class="absolute inset-0 bg-gradient-to-br from-[#c6d379] to-[#e28dc4]"></div>
        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold">Figuras</h4>
        </div>
      </div>

      <div class="relative group overflow-hidden rounded-2xl shadow-lg h-48 md:h-64 cursor-pointer">
        <div class="absolute inset-0 bg-gradient-to-br from-[#5f3917] to-[#e28dc4]"></div>
        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold">Eventos</h4>
        </div>
      </div>

    </div>

    <div class="text-center">
      <a href="{{ route('galeria') }}" class="inline-block px-8 py-4 bg-[#5f3917] text-white rounded-full font-semibold hover:bg-[#e28dc4] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
        Ver Galería Completa
      </a>
    </div>
  </div>
</section>

<!-- Contact CTA Section -->
<section class="relative py-20 bg-gradient-to-b from-white to-pink-50">
  <!-- Wave divider top -->
  <div class="absolute -top-1 left-0 w-full overflow-hidden leading-none rotate-180">
    <svg class="relative block w-full h-16 md:h-20" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" fill="white"></path>
    </svg>
  </div>

  <div class="container-choco pt-12">
    <div class="max-w-4xl mx-auto text-center">
      <h2 class="text-3xl md:text-4xl lg:text-5xl font-['Dancing_Script'] text-[#5f3917] mb-6">
        ¿Listo para endulzar tu día?
      </h2>
      <p class="text-lg md:text-xl text-gray-700 mb-8 max-w-2xl mx-auto">
        Contáctanos para pedidos personalizados, información sobre cursos o cualquier consulta
      </p>

      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
        <a href="{{ route('contacto') }}" class="px-8 py-4 bg-[#5f3917] text-white rounded-full font-semibold hover:bg-[#e28dc4] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
          Contáctanos
        </a>
        <a href="https://wa.me/573001234567" target="_blank" class="px-8 py-4 bg-[#25D366] text-white rounded-full font-semibold hover:bg-[#128C7E] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl inline-flex items-center gap-2">
          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
          </svg>
          WhatsApp
        </a>
      </div>

      <div class="grid md:grid-cols-3 gap-6 max-w-3xl mx-auto">

        <div class="flex flex-col items-center">
          <div class="w-14 h-14 bg-[#e28dc4] rounded-full flex items-center justify-center text-white mb-3">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
              <circle cx="12" cy="10" r="3"></circle>
            </svg>
          </div>
          <h4 class="font-semibold text-[#5f3917] mb-1">Ubicación</h4>
          <p class="text-gray-600 text-sm">Bogotá, Colombia</p>
        </div>

        <div class="flex flex-col items-center">
          <div class="w-14 h-14 bg-[#81cacf] rounded-full flex items-center justify-center text-white mb-3">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
            </svg>
          </div>
          <h4 class="font-semibold text-[#5f3917] mb-1">Email</h4>
          <p class="text-gray-600 text-sm">info@chocoart.com.co</p>
        </div>

        <div class="flex flex-col items-center">
          <div class="w-14 h-14 bg-[#c6d379] rounded-full flex items-center justify-center text-white mb-3">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
              <path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
            </svg>
          </div>
          <h4 class="font-semibold text-[#5f3917] mb-1">Teléfono</h4>
          <p class="text-gray-600 text-sm">+57 300 123 4567</p>
        </div>

      </div>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
