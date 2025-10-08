@extends('layouts.app')

@section('title', 'Galería - Chocoart')

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

  <!-- Wave Divider Bottom -->
  <div class="absolute -bottom-1 left-0 w-full z-10">
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

    /* Lightbox styles */
    .lightbox-hidden{ opacity:0; pointer-events:none; }
    .lightbox-visible{ opacity:1; pointer-events:auto; }
    .lightbox-img-enter{ transform:scale(.9); opacity:0; }
    .lightbox-img-show{ transform:scale(1); opacity:1; }

    /* Gallery hover effects */
    .gallery-item {
      position: relative;
      overflow: hidden;
      cursor: pointer;
    }
    .gallery-item::before {
      content: '🔍';
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%) scale(0);
      font-size: 3rem;
      z-index: 20;
      transition: transform 0.3s ease;
    }
    .gallery-item:hover::before {
      transform: translate(-50%, -50%) scale(1);
    }
  </style>

  <div class="container-choco">
    <!-- Filter Tabs -->
    <div class="flex justify-center gap-3 mb-12 flex-wrap">
      <button class="filter-btn active px-6 py-2 rounded-full font-semibold transition-all duration-300" data-filter="all">
        Todos
      </button>
      <button class="filter-btn px-6 py-2 rounded-full font-semibold transition-all duration-300" data-filter="bombones">
        Bombones
      </button>
      <button class="filter-btn px-6 py-2 rounded-full font-semibold transition-all duration-300" data-filter="tabletas">
        Tabletas
      </button>
      <button class="filter-btn px-6 py-2 rounded-full font-semibold transition-all duration-300" data-filter="figuras">
        Figuras
      </button>
      <button class="filter-btn px-6 py-2 rounded-full font-semibold transition-all duration-300" data-filter="eventos">
        Eventos
      </button>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

      <!-- Gallery Item 1 -->
      <div class="gallery-item col-span-2 md:row-span-2 relative overflow-hidden rounded-2xl shadow-xl h-96 group" data-category="eventos">
        <div class="absolute inset-0 bg-gradient-to-br from-[#e28dc4] to-[#81cacf] transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
          <div class="text-center text-white opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <h4 class="text-2xl md:text-3xl font-semibold mb-2">Evento Corporativo</h4>
            <p class="text-sm">Click para ver más</p>
          </div>
        </div>
      </div>

      <!-- Gallery Item 2 -->
      <div class="gallery-item relative overflow-hidden rounded-2xl shadow-xl h-44 group" data-category="bombones">
        <div class="absolute inset-0 bg-gradient-to-br from-[#c6d379] to-[#e28dc4] transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Bombones Premium</h4>
        </div>
      </div>

      <!-- Gallery Item 3 -->
      <div class="gallery-item relative overflow-hidden rounded-2xl shadow-xl h-44 group" data-category="tabletas">
        <div class="absolute inset-0 bg-gradient-to-br from-[#81cacf] to-[#c6d379] transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Tabletas Artesanales</h4>
        </div>
      </div>

      <!-- Gallery Item 4 -->
      <div class="gallery-item relative overflow-hidden rounded-2xl shadow-xl h-44 group" data-category="figuras">
        <div class="absolute inset-0 bg-gradient-to-br from-[#5f3917] to-[#e28dc4] transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Figuras Decorativas</h4>
        </div>
      </div>

      <!-- Gallery Item 5 -->
      <div class="gallery-item col-span-2 relative overflow-hidden rounded-2xl shadow-xl h-44 group" data-category="eventos">
        <div class="absolute inset-0 bg-gradient-to-br from-[#e28dc4] to-[#c6d379] transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
          <h4 class="text-white text-xl font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Workshop {{ date('Y') }}</h4>
        </div>
      </div>

      <!-- Gallery Item 6 -->
      <div class="gallery-item relative overflow-hidden rounded-2xl shadow-xl h-44 group" data-category="bombones">
        <div class="absolute inset-0 bg-gradient-to-br from-[#e28dc4] via-[#81cacf] to-[#c6d379] transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Bombones Gourmet</h4>
        </div>
      </div>

      <!-- Gallery Item 7 -->
      <div class="gallery-item relative overflow-hidden rounded-2xl shadow-xl h-44 group" data-category="tabletas">
        <div class="absolute inset-0 bg-gradient-to-br from-[#81cacf] to-[#5f3917] transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Tabletas Especiales</h4>
        </div>
      </div>

      <!-- Gallery Item 8 -->
      <div class="gallery-item col-span-2 relative overflow-hidden rounded-2xl shadow-xl h-56 group" data-category="eventos">
        <div class="absolute inset-0 bg-gradient-to-br from-[#81cacf] to-[#e28dc4] transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
          <h4 class="text-white text-2xl font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Bodas & Celebraciones</h4>
        </div>
      </div>

      <!-- Gallery Item 9 -->
      <div class="gallery-item relative overflow-hidden rounded-2xl shadow-xl h-56 group" data-category="figuras">
        <div class="absolute inset-0 bg-gradient-to-br from-[#c6d379] to-[#5f3917] transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Figuras Personalizadas</h4>
        </div>
      </div>

      <!-- Gallery Item 10 -->
      <div class="gallery-item relative overflow-hidden rounded-2xl shadow-xl h-56 group" data-category="bombones">
        <div class="absolute inset-0 bg-gradient-to-br from-[#e28dc4] to-[#5f3917] transition-transform duration-500 group-hover:scale-110"></div>
        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition-all duration-300 flex items-center justify-center">
          <h4 class="text-white text-lg font-semibold opacity-0 group-hover:opacity-100 transition-opacity">Colección Premium</h4>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-[200] flex items-center justify-center lightbox-hidden transition-opacity duration-300">
  <div id="lightboxBackdrop" class="absolute inset-0 bg-black/90"></div>

  <div class="relative z-10 w-[95%] max-w-5xl mx-auto">
    <!-- Image Container -->
    <div class="relative bg-black rounded-2xl overflow-hidden shadow-2xl">
      <img id="lightboxImage" src="" alt="Gallery Image" class="w-full h-auto max-h-[85vh] object-contain transition-all duration-300 lightbox-img-enter">

      <!-- Navigation Arrows -->
      <button id="lightboxPrev" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white text-2xl transition-all" aria-label="Anterior">
        ‹
      </button>
      <button id="lightboxNext" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white text-2xl transition-all" aria-label="Siguiente">
        ›
      </button>

      <!-- Close Button -->
      <button id="lightboxClose" class="absolute top-4 right-4 w-10 h-10 bg-white/20 hover:bg-white/30 backdrop-blur-sm rounded-full flex items-center justify-center text-white text-xl transition-all" aria-label="Cerrar">
        ✕
      </button>

      <!-- Image Info -->
      <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/80 to-transparent p-6 text-white">
        <h3 id="lightboxTitle" class="text-2xl font-['Dancing_Script'] mb-1">Título de la imagen</h3>
        <p id="lightboxCounter" class="text-sm opacity-75">1 / 10</p>
      </div>
    </div>
  </div>
</div>

<!-- Scripts -->
<script>
  (() => {
    // Filter functionality
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');

    filterBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        const filter = btn.dataset.filter;

        // Update active state
        filterBtns.forEach(b => {
          b.classList.remove('active', 'bg-[#5f3917]', 'text-white');
          b.classList.add('bg-gray-200', 'text-gray-700');
        });
        btn.classList.add('active', 'bg-[#5f3917]', 'text-white');
        btn.classList.remove('bg-gray-200', 'text-gray-700');

        // Filter items
        galleryItems.forEach(item => {
          if (filter === 'all' || item.dataset.category === filter) {
            item.style.display = 'block';
            setTimeout(() => {
              item.style.opacity = '1';
              item.style.transform = 'scale(1)';
            }, 10);
          } else {
            item.style.opacity = '0';
            item.style.transform = 'scale(0.8)';
            setTimeout(() => {
              item.style.display = 'none';
            }, 300);
          }
        });
      });
    });

    // Initialize first button as active
    filterBtns[0].classList.add('active', 'bg-[#5f3917]', 'text-white');
    filterBtns.forEach((btn, i) => {
      if (i !== 0) {
        btn.classList.add('bg-gray-200', 'text-gray-700');
      }
    });

    // Lightbox functionality
    const lightbox = document.getElementById('lightbox');
    const lightboxBackdrop = document.getElementById('lightboxBackdrop');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxTitle = document.getElementById('lightboxTitle');
    const lightboxCounter = document.getElementById('lightboxCounter');
    const lightboxClose = document.getElementById('lightboxClose');
    const lightboxPrev = document.getElementById('lightboxPrev');
    const lightboxNext = document.getElementById('lightboxNext');

    let currentIndex = 0;
    const images = Array.from(galleryItems).map((item, index) => ({
      src: item.querySelector('.absolute')?.style.background || `https://via.placeholder.com/800x600/e28dc4/ffffff?text=Chocoart+${index + 1}`,
      title: item.querySelector('h4')?.textContent || `Imagen ${index + 1}`,
      gradient: item.querySelector('.absolute')?.classList.value || ''
    }));

    function openLightbox(index) {
      currentIndex = index;
      updateLightbox();
      lightbox.classList.remove('lightbox-hidden');
      lightbox.classList.add('lightbox-visible');
      document.body.style.overflow = 'hidden';

      setTimeout(() => {
        lightboxImage.classList.remove('lightbox-img-enter');
        lightboxImage.classList.add('lightbox-img-show');
      }, 10);
    }

    function closeLightbox() {
      lightboxImage.classList.remove('lightbox-img-show');
      lightboxImage.classList.add('lightbox-img-enter');

      setTimeout(() => {
        lightbox.classList.remove('lightbox-visible');
        lightbox.classList.add('lightbox-hidden');
        document.body.style.overflow = '';
      }, 200);
    }

    function updateLightbox() {
      // Since we're using gradients, create a visual representation
      const gradient = images[currentIndex].gradient;
      lightboxImage.style.display = 'none';

      // Create gradient preview
      const container = lightboxImage.parentElement;
      let previewDiv = container.querySelector('.gradient-preview');
      if (!previewDiv) {
        previewDiv = document.createElement('div');
        previewDiv.className = 'gradient-preview w-full h-96 rounded-lg';
        lightboxImage.after(previewDiv);
      }

      previewDiv.className = gradient + ' gradient-preview w-full h-96 rounded-lg flex items-center justify-center';
      previewDiv.innerHTML = `<div class="text-white text-6xl">🍫</div>`;

      lightboxTitle.textContent = images[currentIndex].title;
      lightboxCounter.textContent = `${currentIndex + 1} / ${images.length}`;
    }

    function nextImage() {
      currentIndex = (currentIndex + 1) % images.length;
      updateLightbox();
    }

    function prevImage() {
      currentIndex = (currentIndex - 1 + images.length) % images.length;
      updateLightbox();
    }

    // Event listeners
    galleryItems.forEach((item, index) => {
      item.addEventListener('click', () => openLightbox(index));
    });

    lightboxClose.addEventListener('click', closeLightbox);
    lightboxBackdrop.addEventListener('click', closeLightbox);
    lightboxNext.addEventListener('click', nextImage);
    lightboxPrev.addEventListener('click', prevImage);

    // Keyboard navigation
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
