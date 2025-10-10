@extends('layouts.app')

@section('title', 'Blog - Chocoart')

@section('content')

<!-- Hero Blog -->
<section class="relative overflow-hidden bg-gradient-to-br from-[#3d2817] via-[#5f3917] to-[#3d2817] py-24">
  <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/svg%3E');"></div>

  <div class="container-choco relative z-10">
    <div class="text-center max-w-4xl mx-auto">
      <h1 class="font-['Dancing_Script'] text-5xl md:text-6xl lg:text-7xl text-[#e28dc4] mb-4 drop-shadow-lg">
        Blog Chocoart
      </h1>
      <p class="text-lg md:text-xl text-white/90 mb-8">
        Consejos, recetas y el fascinante mundo del chocolate artesanal
      </p>
    </div>
  </div>

  <!-- Wave Divider Bottom - Mobile (sutiles) -->
  <div class="lg:hidden absolute -bottom-1 left-0 w-full z-10 overflow-hidden">
    <svg class="w-full h-20 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,60 Q50,20 100,60 T200,60 T300,60 T400,60 T500,60 T600,60 T700,60 T800,60 T900,60 T1000,60 T1100,60 T1200,60 L1200,120 L0,120 Z" fill="white"/>
    </svg>
  </div>

  <!-- Wave Divider Bottom - Desktop (pronunciadas) -->
  <div class="hidden lg:block absolute -bottom-1 left-0 w-full z-10 overflow-hidden">
    <svg class="w-full h-16 md:h-20" viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,30 Q15,0 30,30 T60,30 T90,30 T120,30 T150,30 T180,30 T210,30 T240,30 T270,30 T300,30 T330,30 T360,30 T390,30 T420,30 T450,30 T480,30 T510,30 T540,30 T570,30 T600,30 T630,30 T660,30 T690,30 T720,30 T750,30 T780,30 T810,30 T840,30 T870,30 T900,30 T930,30 T960,30 T990,30 T1020,30 T1050,30 T1080,30 T1110,30 T1140,30 T1170,30 T1200,30 L1200,60 L0,60 Z" fill="white"/>
    </svg>
  </div>
</section>

<!-- Blog Posts Section -->
<section class="py-20 bg-white">
  <div class="container-choco">
    <div class="text-center mb-16">
      <h2 class="font-['Dancing_Script'] text-4xl md:text-5xl text-[#81cacf] mb-3">
        Últimas Publicaciones
      </h2>
      <p class="text-gray-600 max-w-2xl mx-auto text-lg">
        Descubre historias, técnicas y secretos del mundo del chocolate
      </p>
    </div>

    <!-- Blog Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">

      <!-- Blog Post 1 -->
      <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="h-56 bg-gradient-to-br from-[#e28dc4] to-[#81cacf] relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center text-7xl">
            🍫
          </div>
          <div class="absolute top-4 right-4 bg-[#5f3917] text-white px-3 py-1 rounded-full text-xs font-semibold">
            Técnicas
          </div>
        </div>
        <div class="p-6">
          <div class="text-sm text-gray-500 mb-2">15 de Septiembre, 2024</div>
          <h3 class="text-xl font-bold text-[#5f3917] mb-3 group-hover:text-[#e28dc4] transition-colors">
            El Arte del Templado del Chocolate
          </h3>
          <p class="text-gray-600 mb-4">
            Descubre los secretos para lograr el templado perfecto y obtener ese brillo característico en tus chocolates artesanales.
          </p>
          <a href="{{ route('blog.post', 'arte-templado-chocolate') }}" class="inline-flex items-center gap-2 text-[#81cacf] font-semibold hover:text-[#5f3917] transition-colors">
            Leer más
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        </div>
      </article>

      <!-- Blog Post 2 -->
      <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="h-56 bg-gradient-to-br from-[#81cacf] to-[#c6d379] relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center text-7xl">
            🎨
          </div>
          <div class="absolute top-4 right-4 bg-[#5f3917] text-white px-3 py-1 rounded-full text-xs font-semibold">
            Decoración
          </div>
        </div>
        <div class="p-6">
          <div class="text-sm text-gray-500 mb-2">10 de Septiembre, 2024</div>
          <h3 class="text-xl font-bold text-[#5f3917] mb-3 group-hover:text-[#e28dc4] transition-colors">
            Técnicas de Decoración con Transfer
          </h3>
          <p class="text-gray-600 mb-4">
            Aprende a crear diseños impresionantes usando la técnica de transfer y lleva tus chocolates al siguiente nivel.
          </p>
          <a href="{{ route('blog.post', 'tecnicas-decoracion-transfer') }}" class="inline-flex items-center gap-2 text-[#81cacf] font-semibold hover:text-[#5f3917] transition-colors">
            Leer más
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        </div>
      </article>

      <!-- Blog Post 3 -->
      <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="h-56 bg-gradient-to-br from-[#c6d379] to-[#e28dc4] relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center text-7xl">
            🌱
          </div>
          <div class="absolute top-4 right-4 bg-[#5f3917] text-white px-3 py-1 rounded-full text-xs font-semibold">
            Ingredientes
          </div>
        </div>
        <div class="p-6">
          <div class="text-sm text-gray-500 mb-2">5 de Septiembre, 2024</div>
          <h3 class="text-xl font-bold text-[#5f3917] mb-3 group-hover:text-[#e28dc4] transition-colors">
            Chocolate de Origen: Qué es y Por Qué Importa
          </h3>
          <p class="text-gray-600 mb-4">
            Explora el fascinante mundo del cacao de origen único y cómo impacta el sabor de tus creaciones.
          </p>
          <a href="{{ route('blog.post', 'chocolate-origen') }}" class="inline-flex items-center gap-2 text-[#81cacf] font-semibold hover:text-[#5f3917] transition-colors">
            Leer más
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        </div>
      </article>

      <!-- Blog Post 4 -->
      <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="h-56 bg-gradient-to-br from-[#5f3917] to-[#c6d379] relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center text-7xl">
            💼
          </div>
          <div class="absolute top-4 right-4 bg-[#e28dc4] text-white px-3 py-1 rounded-full text-xs font-semibold">
            Negocio
          </div>
        </div>
        <div class="p-6">
          <div class="text-sm text-gray-500 mb-2">28 de Agosto, 2024</div>
          <h3 class="text-xl font-bold text-[#5f3917] mb-3 group-hover:text-[#e28dc4] transition-colors">
            Cómo Iniciar tu Negocio de Chocolatería
          </h3>
          <p class="text-gray-600 mb-4">
            Consejos prácticos para convertir tu pasión por el chocolate en un emprendimiento exitoso.
          </p>
          <a href="{{ route('blog.post', 'iniciar-negocio-chocolateria') }}" class="inline-flex items-center gap-2 text-[#81cacf] font-semibold hover:text-[#5f3917] transition-colors">
            Leer más
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        </div>
      </article>

      <!-- Blog Post 5 -->
      <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="h-56 bg-gradient-to-br from-[#e28dc4] to-[#c6d379] relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center text-7xl">
            🍬
          </div>
          <div class="absolute top-4 right-4 bg-[#5f3917] text-white px-3 py-1 rounded-full text-xs font-semibold">
            Recetas
          </div>
        </div>
        <div class="p-6">
          <div class="text-sm text-gray-500 mb-2">20 de Agosto, 2024</div>
          <h3 class="text-xl font-bold text-[#5f3917] mb-3 group-hover:text-[#e28dc4] transition-colors">
            5 Rellenos Gourmet para Bombones
          </h3>
          <p class="text-gray-600 mb-4">
            Ideas innovadoras de rellenos que harán que tus bombones sean inolvidables y sorprendan a tus clientes.
          </p>
          <a href="{{ route('blog.post', 'rellenos-gourmet-bombones') }}" class="inline-flex items-center gap-2 text-[#81cacf] font-semibold hover:text-[#5f3917] transition-colors">
            Leer más
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        </div>
      </article>

      <!-- Blog Post 6 -->
      <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="h-56 bg-gradient-to-br from-[#81cacf] to-[#e28dc4] relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center text-7xl">
            📚
          </div>
          <div class="absolute top-4 right-4 bg-[#5f3917] text-white px-3 py-1 rounded-full text-xs font-semibold">
            Historia
          </div>
        </div>
        <div class="p-6">
          <div class="text-sm text-gray-500 mb-2">12 de Agosto, 2024</div>
          <h3 class="text-xl font-bold text-[#5f3917] mb-3 group-hover:text-[#e28dc4] transition-colors">
            La Historia del Chocolate: Del Cacao a tu Mesa
          </h3>
          <p class="text-gray-600 mb-4">
            Un viaje fascinante por la historia del chocolate, desde las civilizaciones antiguas hasta hoy.
          </p>
          <a href="{{ route('blog.post', 'historia-chocolate') }}" class="inline-flex items-center gap-2 text-[#81cacf] font-semibold hover:text-[#5f3917] transition-colors">
            Leer más
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        </div>
      </article>

    </div>

    <!-- Pagination -->
    <div class="mt-12 flex justify-center">
      <nav class="flex items-center gap-2">
        <a href="#" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-400 cursor-not-allowed">
          Anterior
        </a>
        <a href="#" class="px-4 py-2 rounded-lg bg-[#e28dc4] text-white font-semibold">
          1
        </a>
        <a href="#" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-[#81cacf] hover:text-white transition-colors">
          2
        </a>
        <a href="#" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-[#81cacf] hover:text-white transition-colors">
          3
        </a>
        <a href="#" class="px-4 py-2 rounded-lg bg-gray-100 text-gray-700 hover:bg-[#e28dc4] hover:text-white transition-colors">
          Siguiente
        </a>
      </nav>
    </div>
  </div>
</section>

<!-- Newsletter Section -->
<section class="py-20 bg-gradient-to-br from-pink-50 via-blue-50 to-lime-50">
  <div class="container-choco">
    <div class="max-w-3xl mx-auto text-center">
      <h2 class="font-['Dancing_Script'] text-4xl md:text-5xl text-[#5f3917] mb-4">
        Suscríbete al Newsletter
      </h2>
      <p class="text-gray-600 mb-8 text-lg">
        Recibe consejos, recetas exclusivas y novedades directamente en tu correo
      </p>
      <form class="flex flex-col sm:flex-row gap-4 max-w-xl mx-auto">
        <input
          type="email"
          placeholder="Tu correo electrónico"
          class="flex-1 px-6 py-4 rounded-full border-2 border-[#81cacf] focus:outline-none focus:border-[#e28dc4] transition-colors"
        >
        <button
          type="submit"
          class="px-8 py-4 bg-[#5f3917] text-white rounded-full font-semibold hover:bg-[#e28dc4] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl"
        >
          Suscribirme
        </button>
      </form>
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
