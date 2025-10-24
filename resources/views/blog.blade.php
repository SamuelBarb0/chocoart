@extends('layouts.app')

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

    @if($posts->count() > 0)
    <!-- Blog Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
      @foreach($posts as $post)
      <!-- Blog Post: {{ $post->title }} -->
      <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="h-56 bg-gradient-to-br {{ $post->gradient }} relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center text-7xl">
            {{ $post->icon }}
          </div>
          @php
            $categoryRelation = $post->relationLoaded('category') ? $post->getRelation('category') : null;
          @endphp
          @if($categoryRelation)
          <div class="absolute top-4 right-4 bg-[#5f3917] text-white px-3 py-1 rounded-full text-xs font-semibold">
            {{ $categoryRelation->name }}
          </div>
          @elseif(is_string($post->category) && $post->category)
          <div class="absolute top-4 right-4 bg-[#5f3917] text-white px-3 py-1 rounded-full text-xs font-semibold">
            {{ $post->category }}
          </div>
          @endif
        </div>
        <div class="p-6">
          <div class="text-sm text-gray-500 mb-2">
            {{ $post->published_at ? $post->published_at->translatedFormat('d \d\e F, Y') : 'Sin fecha' }}
          </div>
          <h3 class="text-xl font-bold text-[#5f3917] mb-3 group-hover:text-[#e28dc4] transition-colors">
            {{ $post->title }}
          </h3>
          <p class="text-gray-600 mb-4">
            {{ $post->excerpt }}
          </p>
          <div class="flex items-center justify-between">
            <a href="{{ route('blog.post', $post->slug) }}" class="inline-flex items-center gap-2 text-[#81cacf] font-semibold hover:text-[#5f3917] transition-colors">
              Leer más
              <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
              </svg>
            </a>
            @if($post->read_time)
            <span class="text-sm text-gray-400">{{ $post->read_time }} min</span>
            @endif
          </div>
        </div>
      </article>
      @endforeach
    </div>
    @else
    <!-- Sin posts -->
    <div class="text-center py-16">
      <div class="text-6xl mb-4">📝</div>
      <h3 class="text-2xl font-semibold text-gray-700 mb-2">Próximamente</h3>
      <p class="text-gray-500">Estamos preparando contenido increíble sobre el mundo del chocolate</p>
    </div>
    @endif
  </div>
</section>


@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
