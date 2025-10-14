@extends('layouts.app')

@section('title', 'Galería - Chocoart')

@php
    // Asegura que $images exista como colección
    $images = isset($images) ? collect($images) : collect();

    // Si $categories no llegó desde el controlador, lo derivamos de $images
    if (!isset($categories)) {
        $categories = $images
            ->pluck('category')
            ->filter()
            ->unique()
            ->values()
            ->map(function ($c) {
                return [
                    'label' => $c,
                    'slug'  => \Illuminate\Support\Str::of($c)->lower()->slug('-'),
                ];
            });
    }
@endphp


@section('content')

<!-- Hero Galería -->
<section class="relative overflow-hidden bg-gradient-to-br from-[#3d2817] via-[#5f3917] to-[#3d2817] py-24">
  <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/svg%3E');"></div>

  <div class="container-choco relative z-10">
    <div class="text-center max-w-4xl mx-auto">
      <h1 class="font-['Dancing_Script'] text-5xl md:text-6xl lg:text-7xl text-[#e28dc4] mb-4 drop-shadow-lg">
        Galería de Creaciones
      </h1>
      <p class="text-lg md:text-xl text-white/90 mb-8">
        Un vistazo a nuestras obras de arte comestibles
      </p>
    </div>
  </div>

  <!-- Wave Divider Bottom - Mobile -->
  <div class="lg:hidden absolute -bottom-1 left-0 w-full z-10 overflow-hidden">
    <svg class="w-full h-20 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,60 Q50,20 100,60 T200,60 T300,60 T400,60 T500,60 T600,60 T700,60 T800,60 T900,60 T1000,60 T1100,60 T1200,60 L1200,120 L0,120 Z" fill="white"/>
    </svg>
  </div>

  <!-- Wave Divider Bottom - Desktop -->
  <div class="hidden lg:block absolute -bottom-1 left-0 w-full z-10 overflow-hidden">
    <svg class="w-full h-16 md:h-20" viewBox="0 0 1200 60" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M0,30 Q15,0 30,30 T60,30 T90,30 T120,30 T150,30 T180,30 T210,30 T240,30 T270,30 T300,30 T330,30 T360,30 T390,30 T420,30 T450,30 T480,30 T510,30 T540,30 T570,30 T600,30 T630,30 T660,30 T690,30 T720,30 T750,30 T780,30 T810,30 T840,30 T870,30 T900,30 T930,30 T960,30 T990,30 T1020,30 T1050,30 T1080,30 T1110,30 T1140,30 T1170,30 T1200,30 L1200,60 L0,60 Z" fill="white"/>
    </svg>
  </div>
</section>

<!-- Gallery Section -->
<section class="py-20 bg-white">
  <style>
    :root{
      --rosa:#e28dc4;
      --menta:#81cacf;
      --pistacho:#c6d379;
      --choco:#5f3917;
    }
    .lightbox-hidden{ opacity:0; pointer-events:none; }
    .lightbox-visible{ opacity:1; pointer-events:auto; }
    .lightbox-img-enter{ transform:scale(.98); opacity:0; }
    .lightbox-img-show{ transform:scale(1); opacity:1; }
    .gallery-item { position: relative; overflow: hidden; cursor: pointer; }
    .gallery-item::before {
      content: '🔍';
      position: absolute; top: 50%; left: 50%;
      transform: translate(-50%, -50%) scale(0);
      font-size: 3rem; z-index: 20; transition: transform .3s ease;
    }
    .gallery-item:hover::before { transform: translate(-50%, -50%) scale(1); }
  </style>

  <div class="container-choco">
    <!-- Filter Tabs -->
    <div class="flex justify-center gap-3 mb-12 flex-wrap">
      <button class="filter-btn active px-6 py-2 rounded-full font-semibold transition-all duration-300" data-filter="all">
        Todos
      </button>

      @foreach($categories as $cat)
        <button class="filter-btn px-6 py-2 rounded-full font-semibold transition-all duration-300" data-filter="{{ $cat['slug'] }}">
          {{ $cat['label'] }}
        </button>
      @endforeach
    </div>

    <!-- Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @forelse($images as $img)
        @php
          // Decide tamaño según featured
          $classes = $img->featured
            ? 'col-span-2 md:row-span-2 h-96'
            : 'h-44';
        @endphp

        <div
          class="gallery-item relative overflow-hidden rounded-2xl shadow-xl group {{ $classes }}"
          data-category="{{ $img->category_slug }}"
          data-src="{{ $img->image_url }}"
          data-title="{{ $img->title }}"
          data-description="{{ $img->description }}"
        >
          <!-- Fondo imagen -->
          <img
            src="{{ $img->image_url }}"
            alt="{{ $img->title }}"
            class="absolute inset-0 w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
            loading="lazy"
          />

          <!-- Overlay gradiente -->
          <div class="absolute inset-0 bg-gradient-to-br {{ $img->gradient_class }} opacity-0 group-hover:opacity-40 transition-opacity duration-300"></div>

          <!-- Capa hover -->
          <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center p-4">
            <div class="text-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <h4 class="text-lg md:text-xl font-semibold mb-1">{{ $img->title }}</h4>
              @if($img->category)
                <p class="text-xs uppercase tracking-wide opacity-80">{{ $img->category }}</p>
              @endif
            </div>
          </div>
        </div>
      @empty
        <div class="col-span-4 text-center text-gray-500">Aún no hay imágenes en la galería.</div>
      @endforelse
    </div>
  </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-[200] flex items-center justify-center lightbox-hidden transition-opacity duration-300">
  <div id="lightboxBackdrop" class="absolute inset-0 bg-black/90"></div>

  <div class="relative z-10 w-[95%] max-w-5xl mx-auto">
    <div class="relative bg-black rounded-2xl overflow-hidden shadow-2xl">
      <img id="lightboxImage" src="" alt="Gallery Image" class="w-full h-auto max-h-[85vh] object-contain transition-all duration-300 lightbox-img-enter">

      <!-- Nav -->
      <button id="lightboxPrev" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white text-2xl transition-all" aria-label="Anterior">‹</button>
      <button id="lightboxNext" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white text-2xl transition-all" aria-label="Siguiente">›</button>

      <!-- Close -->
      <button id="lightboxClose" class="absolute top-4 right-4 w-10 h-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white text-xl transition-all" aria-label="Cerrar">✕</button>

      <!-- Info -->
      <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 text-white">
        <h3 id="lightboxTitle" class="text-2xl font-['Dancing_Script'] mb-1">Título de la imagen</h3>
        <p id="lightboxCounter" class="text-sm opacity-75">1 / 1</p>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script>
  (() => {
    // Filtros
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    const applyFilter = (filter) => {
      galleryItems.forEach(item => {
        const match = (filter === 'all') || (item.dataset.category === filter);
        if (match) {
          item.style.display = 'block';
          setTimeout(() => { item.style.opacity = '1'; item.style.transform = 'scale(1)'; }, 10);
        } else {
          item.style.opacity = '0';
          item.style.transform = 'scale(0.98)';
          setTimeout(() => { item.style.display = 'none'; }, 200);
        }
      });
    }

    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const filter = btn.dataset.filter;

        filterBtns.forEach(b => {
          b.classList.remove('active', 'bg-[#5f3917]', 'text-white');
          b.classList.add('bg-gray-200', 'text-gray-700');
        });
        btn.classList.add('active', 'bg-[#5f3917]', 'text-white');
        btn.classList.remove('bg-gray-200', 'text-gray-700');

        applyFilter(filter);
      });
    });

    // Estado inicial
    filterBtns.forEach((btn, i) => {
      if (i === 0) btn.classList.add('active', 'bg-[#5f3917]', 'text-white');
      else btn.classList.add('bg-gray-200', 'text-gray-700');
    });

    // Lightbox
    const lightbox = document.getElementById('lightbox');
    const lightboxBackdrop = document.getElementById('lightboxBackdrop');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxCounter = document.getElementById('lightboxCounter');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');

    let currentIndex = 0;
    const items = Array.from(galleryItems);

    const openLightbox = (index) => {
      currentIndex = index;
      updateLightbox();
      lightbox.classList.remove('lightbox-hidden');
      lightbox.classList.add('lightbox-visible');
      document.body.style.overflow = 'hidden';
      setTimeout(() => {
        lightboxImage.classList.remove('lightbox-img-enter');
        lightboxImage.classList.add('lightbox-img-show');
      }, 10);
    };

    const closeLightbox = () => {
      lightboxImage.classList.remove('lightbox-img-show');
      lightboxImage.classList.add('lightbox-img-enter');
      setTimeout(() => {
        lightbox.classList.remove('lightbox-visible');
        lightbox.classList.add('lightbox-hidden');
        document.body.style.overflow = '';
      }, 150);
    };

    const updateLightbox = () => {
      const visibleItems = items.filter(i => i.style.display !== 'none');
      const item = visibleItems[currentIndex] || items[currentIndex];

      lightboxImage.style.display = 'block';
      lightboxImage.src = item.dataset.src;
      lightboxTitle.textContent = item.dataset.title || 'Imagen';
      lightboxCounter.textContent = `${currentIndex + 1} / ${visibleItems.length || items.length}`;
    };

    const nextImage = () => {
      const visibleItems = items.filter(i => i.style.display !== 'none');
      currentIndex = (currentIndex + 1) % (visibleItems.length || items.length);
      updateLightbox();
    };

    const prevImage = () => {
      const visibleItems = items.filter(i => i.style.display !== 'none');
      currentIndex = (currentIndex - 1 + (visibleItems.length || items.length)) % (visibleItems.length || items.length);
      updateLightbox();
    };

    items.forEach((item, index) => {
      item.addEventListener('click', () => {
        // Recalcular índice relativo a visibles
        const visibleItems = items.filter(i => i.style.display !== 'none');
        const idx = visibleItems.indexOf(item);
        openLightbox(idx >= 0 ? idx : index);
      });
    });

    lightboxClose.addEventListener('click', closeLightbox);
    lightboxBackdrop.addEventListener('click', closeLightbox);
    lightboxNext.addEventListener('click', nextImage);
    lightboxPrev.addEventListener('click', prevImage);

    document.addEventListener('keydown', (e) => {
      if (!lightbox.classList.contains('lightbox-visible')) return;
      if (e.key === 'Escape') closeLightbox();
      if (e.key === 'ArrowRight') nextImage();
      if (e.key === 'ArrowLeft') prevImage();
    });
  })();
</script>

@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
