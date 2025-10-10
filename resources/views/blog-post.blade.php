@extends('layouts.app')

@section('title', $title . ' - Blog Chocoart')

@section('content')

<!-- Hero Post -->
<section class="relative overflow-hidden bg-gradient-to-br from-[#3d2817] via-[#5f3917] to-[#3d2817] py-20">
  <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/svg%3E');"></div>

  <div class="container-choco relative z-10">
    <div class="max-w-4xl mx-auto">
      <!-- Back button -->
      <a href="{{ route('blog') }}" class="inline-flex items-center gap-2 text-white/80 hover:text-white mb-6 transition-colors group">
        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        Volver al Blog
      </a>

      <!-- Category Badge -->
      <div class="mb-4">
        <span class="inline-block bg-[#e28dc4] text-white px-4 py-2 rounded-full text-sm font-semibold">
          {{ $category }}
        </span>
      </div>

      <!-- Title -->
      <h1 class="font-['Dancing_Script'] text-4xl md:text-5xl lg:text-6xl text-white mb-4 leading-tight">
        {{ $title }}
      </h1>

      <!-- Meta -->
      <div class="flex flex-wrap items-center gap-4 text-white/70 text-sm">
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
          </svg>
          {{ $date }}
        </div>
        <div class="flex items-center gap-2">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          {{ $readTime }} min de lectura
        </div>
      </div>
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

<!-- Post Content -->
<article class="py-16 bg-white">
  <div class="container-choco">
    <div class="max-w-4xl mx-auto">

      <!-- Featured Image -->
      <div class="mb-12 rounded-2xl overflow-hidden shadow-2xl">
        <div class="h-96 bg-gradient-to-br {{ $gradient }} relative">
          <div class="absolute inset-0 flex items-center justify-center text-9xl">
            {{ $icon }}
          </div>
        </div>
      </div>

      <!-- Content -->
      <div class="prose prose-lg max-w-none">
        {!! $content !!}
      </div>

      <!-- Share Section -->
      <div class="mt-12 pt-8 border-t-2 border-gray-200">
        <h3 class="text-lg font-semibold text-[#5f3917] mb-4">Compartir este artículo:</h3>
        <div class="flex gap-3">
          <a href="#" class="w-12 h-12 rounded-full bg-[#e28dc4] text-white flex items-center justify-center hover:bg-[#5f3917] transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
          </a>
          <a href="#" class="w-12 h-12 rounded-full bg-[#81cacf] text-white flex items-center justify-center hover:bg-[#5f3917] transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"/></svg>
          </a>
          <a href="#" class="w-12 h-12 rounded-full bg-[#c6d379] text-white flex items-center justify-center hover:bg-[#5f3917] transition-colors">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
          </a>
        </div>
      </div>

    </div>
  </div>
</article>

<!-- Related Posts -->
<section class="py-20 bg-gradient-to-br from-pink-50 via-blue-50 to-lime-50">
  <div class="container-choco">
    <div class="text-center mb-12">
      <h2 class="font-['Dancing_Script'] text-4xl md:text-5xl text-[#5f3917] mb-4">
        Artículos Relacionados
      </h2>
      <p class="text-gray-600 text-lg">
        Continúa explorando más contenido sobre chocolate
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
      @foreach($relatedPosts as $post)
      <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2">
        <div class="h-48 bg-gradient-to-br {{ $post['gradient'] }} relative overflow-hidden">
          <div class="absolute inset-0 flex items-center justify-center text-6xl">
            {{ $post['icon'] }}
          </div>
        </div>
        <div class="p-6">
          <h3 class="text-lg font-bold text-[#5f3917] mb-2 group-hover:text-[#e28dc4] transition-colors">
            {{ $post['title'] }}
          </h3>
          <p class="text-gray-600 text-sm mb-4">
            {{ $post['excerpt'] }}
          </p>
          <a href="{{ route('blog.post', $post['slug']) }}" class="inline-flex items-center gap-2 text-[#81cacf] font-semibold hover:text-[#5f3917] transition-colors text-sm">
            Leer más
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
            </svg>
          </a>
        </div>
      </article>
      @endforeach
    </div>

    <div class="text-center mt-12">
      <a href="{{ route('blog') }}" class="inline-block px-8 py-4 bg-[#5f3917] text-white rounded-full font-semibold hover:bg-[#e28dc4] transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
        Ver Todos los Artículos
      </a>
    </div>
  </div>
</section>

<style>
  /* Prose styling for article content */
  .prose {
    color: #374151;
  }
  .prose h2 {
    font-family: 'Dancing Script', cursive;
    color: #5f3917;
    font-size: 2.5rem;
    margin-top: 2rem;
    margin-bottom: 1rem;
  }
  .prose h3 {
    color: #5f3917;
    font-size: 1.875rem;
    font-weight: 600;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
  }
  .prose h4 {
    color: #e28dc4;
    font-size: 1.5rem;
    font-weight: 600;
    margin-top: 1.25rem;
    margin-bottom: 0.5rem;
  }
  .prose p {
    margin-bottom: 1.25rem;
    line-height: 1.75;
  }
  .prose ul, .prose ol {
    margin-left: 1.5rem;
    margin-bottom: 1.25rem;
  }
  .prose li {
    margin-bottom: 0.5rem;
  }
  .prose strong {
    color: #5f3917;
    font-weight: 600;
  }
  .prose a {
    color: #81cacf;
    text-decoration: underline;
  }
  .prose a:hover {
    color: #e28dc4;
  }
  .prose blockquote {
    border-left: 4px solid #e28dc4;
    padding-left: 1.5rem;
    font-style: italic;
    color: #6b7280;
    margin: 1.5rem 0;
  }
  .prose code {
    background-color: #f3f4f6;
    color: #e28dc4;
    padding: 0.25rem 0.5rem;
    border-radius: 0.375rem;
    font-size: 0.875rem;
  }
  .prose img {
    border-radius: 1rem;
    margin: 2rem 0;
    box-shadow: 0 10px 25px rgba(0,0,0,0.1);
  }
</style>

@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
