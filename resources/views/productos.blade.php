@extends('layouts.app')

@section('content')

<!-- Hero Productos -->
<section class="relative overflow-hidden bg-gradient-to-br from-[#3d2817] via-[#5f3917] to-[#3d2817] py-24">
  <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/svg%3E');"></div>

  <div class="container-choco relative z-10">
    <div class="text-center max-w-4xl mx-auto">
      <h1 class="font-['Dancing_Script'] text-5xl md:text-6xl lg:text-7xl text-[#e28dc4] mb-4 drop-shadow-lg">
        Nuestros Productos
      </h1>
      <p class="text-lg md:text-xl text-white/90 mb-8">
        Cada pieza de chocolate es una obra de arte hecha con amor y los mejores ingredientes
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

<!-- Productos Section -->
<section id="productos" class="py-20 bg-white relative">

  <!-- ====== ESTILOS & PALETA ====== -->
  <style>
    :root{
      --rosa:#e28dc4;
      --menta:#81cacf;
      --pistacho:#c6d379;
      --choco:#5f3917;
    }

    @keyframes spin { to { transform: rotate(360deg); } }
    .text-ring{ animation: spin var(--ring-speed, 14s) linear infinite; transform-origin:50% 50%; will-change:transform; }
    .text-ring.fast{ --ring-speed: 10s; }
    .text-ring.slow{ --ring-speed: 20s; }

    /* Cápsula y hover sincronizado */
    .capsule{ --base-scale:.80; transform: scale(var(--base-scale)); }
    .group:hover .capsule{ transform: translateY(-1rem) scale(calc(var(--base-scale)*1.04)); }
    .group:hover .emoji{ transform: scale(1.1); }
    .group:hover .ring-wrap{ transform: scale(1.02); }
    .group:hover .text-ring{ animation-duration: var(--ring-hover, 6s); }

    @media (prefers-reduced-motion: reduce){
      .text-ring{ animation:none!important; }
      .group:hover .capsule, .group:hover .emoji, .group:hover .ring-wrap{ transform:none!important; }
    }

    /* ===== Modal tarjeta estilo referencia ===== */
    .modal-hidden{ opacity:0; pointer-events:none; }
    .modal-visible{ opacity:1; pointer-events:auto; }
    .modal-panel-enter{ transform:translateY(1rem) scale(.96); opacity:0; }
    .modal-panel-show{ transform:translateY(0) scale(1); opacity:1; }

    /* Tarjeta: rosa → chocolate con brillo suave */
    .card-choco-rose{
      background:
        radial-gradient(120% 120% at 10% 0%, color-mix(in srgb, var(--rosa) 85%, white 0%) 0%, color-mix(in srgb, var(--rosa) 60%, var(--choco) 40%) 45%, var(--choco) 100%);
    }
    .inner-shadow{
      box-shadow:
        inset 0 1px 0 rgba(255,255,255,.25),
        inset 0 -6px 24px rgba(0,0,0,.15),
        0 20px 40px rgba(0,0,0,.25);
    }
    .soft-ring{ box-shadow: 0 0 0 1px rgba(255,255,255,.18); }

    /* Carrusel (menta) */
    .carousel-dot{ background: color-mix(in srgb, var(--menta) 85%, white 15%); opacity:.55; width:10px; height:10px; border-radius:9999px; transition:.2s; }
    .carousel-dot[aria-current="true"]{ opacity:1; transform:scale(1.1); }
    .carousel-arrow{
      background: color-mix(in srgb, var(--menta) 45%, black 15%);
      color:white; backdrop-filter: blur(2px);
    }
    .carousel-arrow:hover{ background: color-mix(in srgb, var(--menta) 65%, black 10%); }

    /* Botones */
    .btn-choco{ background:var(--choco); color:white; }
    .btn-choco:hover{ background:var(--rosa); color:white; }
    .btn-outline-light{ background:rgba(255,255,255,.12); }
    .btn-outline-light:hover{ background:rgba(255,255,255,.18); }

    /* Accesibilidad foco */
    .focus-ring:focus{ outline:3px solid var(--pistacho); outline-offset:2px; }
  </style>

  <div class="container-choco">
    <div class="text-center mb-16">
      <h2 class="font-['Dancing_Script'] text-4xl md:text-5xl lg:text-6xl text-[var(--rosa)] mb-3">
        Catálogo de Chocolates
      </h2>
      <p class="text-gray-600 max-w-2xl mx-auto text-lg">
        Explora nuestra colección de chocolates artesanales premium
      </p>
    </div>

    @if($productos->count() > 0)
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
      @foreach($productos as $index => $producto)
      <!-- Producto {{ $producto->name }} -->
      <div class="group relative">
        <div class="relative mb-6">
          @if($producto->featured)
          <!-- Badge -->
          <div class="absolute -top-3 right-1/4 z-30">
            <div class="relative px-4 py-1 bg-[var(--pistacho)] text-white text-xs font-bold rounded-full shadow-lg">
              DESTACADO
              <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[6px] border-l-transparent border-r-transparent border-t-[var(--pistacho)]"></div>
            </div>
          </div>
          @endif

          <!-- Cápsula + Aro -->
          <div class="relative w-56 h-56 mx-auto isolate">
            <div class="absolute inset-0 rounded-full blur-2xl" style="background: radial-gradient(60% 60% at 30% 20%, color-mix(in srgb, var(--menta) 35%, white 0%) 0%, transparent 70%), radial-gradient(60% 60% at 70% 80%, color-mix(in srgb, var(--pistacho) 35%, white 0%) 0%, transparent 70%);"></div>

            <!-- Aro chocolate -->
            <svg viewBox="0 0 200 200" class="ring-wrap absolute inset-0 z-20 pointer-events-none transition-transform duration-300"
                 aria-hidden="true"
                 style="--ring-hover:6s; mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%); -webkit-mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%);">
              <defs><path id="circlePath-{{ $index }}" d="M100,100 m-86,0 a86,86 0 1,1 172,0 a86,86 0 1,1 -172,0"/></defs>
              <g class="text-ring">
                <text font-size="14.5" font-weight="600" fill="var(--choco)" letter-spacing="3">
                  <textPath href="#circlePath-{{ $index }}">• CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART •</textPath>
                </text>
              </g>
              <circle cx="100" cy="100" r="90" fill="none" stroke="var(--choco)" stroke-width="1.5" opacity=".25"/>
            </svg>

            <!-- Cápsula con imagen o icono -->
            @php
              $mainImage = $producto->image_url ?? $producto->icon_url;
            @endphp

            <div class="capsule relative z-10 w-full h-full bg-gradient-to-br {{ $producto->gradient }} rounded-full shadow-2xl flex items-center justify-center transition-transform duration-500 overflow-hidden">
              @if($mainImage)
                <img src="{{ $mainImage }}" alt="{{ $producto->name }}" class="w-full h-full object-cover" loading="lazy">
              @elseif($producto->icon)
                <div class="emoji text-7xl transition-transform duration-300">{{ $producto->icon }}</div>
              @else
                <div class="emoji text-7xl transition-transform duration-300">🍫</div>
              @endif
            </div>
          </div>
        </div>

        <div class="text-center">
          <h3 class="text-2xl font-semibold text-[var(--choco)] mb-2">{{ $producto->name }}</h3>
          <p class="text-gray-500 text-sm mb-1">{{ $producto->category }}</p>
          @if($producto->price)
          <p class="text-[var(--rosa)] font-bold text-lg mb-3">
            ${{ number_format($producto->price, 0, ',', '.') }}
          </p>
          @else
          <p class="text-gray-400 text-sm mb-3">&nbsp;</p>
          @endif

          <button
            type="button"
            class="open-modal btn-choco focus-ring inline-block px-6 py-2 rounded-full font-semibold transition"
            data-title="{{ $producto->name }}"
            data-subtitle="{{ $producto->category }}"
            data-desc="{{ strip_tags($producto->description) }}"
            data-bullets='[]'
            data-notes=""
            data-images='@json($producto->images_urls)'
          >Ver Detalles</button>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <!-- Sin productos -->
    <div class="text-center py-16">
      <div class="text-6xl mb-4">🍫</div>
      <h3 class="text-2xl font-semibold text-gray-700 mb-2">Próximamente</h3>
      <p class="text-gray-500">Estamos preparando deliciosos chocolates para ti</p>
    </div>
    @endif
  </div>
</section>

<!-- ===== MODAL TARJETA (fondo oscuro) ===== -->
<div id="productModal" class="modal-hidden fixed inset-0 z-50 flex items-center justify-center px-4 transition-opacity duration-300"
     style="background: rgba(0,0,0,0.6); backdrop-filter: blur(4px);"
     aria-labelledby="modalTitle"
     aria-describedby="modalDesc"
     aria-modal="true"
     role="dialog">

  <div class="modal-panel-enter card-choco-rose relative w-full max-w-3xl rounded-3xl text-white p-8 md:p-10 transition-all duration-300 inner-shadow soft-ring">
    <button type="button" class="close-modal absolute top-4 right-4 p-2 rounded-full bg-white/10 hover:bg-white/20 transition focus-ring" aria-label="Cerrar modal">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>

    <div class="flex flex-col md:flex-row gap-8">
      <!-- Carrusel (izquierda) -->
      <div class="md:w-5/12 flex-shrink-0">
        <div class="relative rounded-2xl overflow-hidden bg-white/10 backdrop-blur-sm aspect-square">
          <div id="carouselImages" class="w-full h-full"></div>

          <!-- Controles (solo si >1 foto) -->
          <div id="carouselControls" class="hidden">
            <button type="button" id="prevBtn" class="carousel-arrow absolute left-2 top-1/2 -translate-y-1/2 p-2 rounded-full transition focus-ring" aria-label="Imagen anterior">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </button>
            <button type="button" id="nextBtn" class="carousel-arrow absolute right-2 top-1/2 -translate-y-1/2 p-2 rounded-full transition focus-ring" aria-label="Imagen siguiente">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </button>
            <div id="carouselDots" class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-2"></div>
          </div>
        </div>
      </div>

      <!-- Contenido (derecha) -->
      <div class="md:w-7/12 flex flex-col">
        <h2 id="modalTitle" class="text-3xl md:text-4xl font-['Dancing_Script'] mb-1">Título</h2>
        <p id="modalSubtitle" class="text-white/75 text-sm mb-4">Subtítulo</p>
        <p id="modalDesc" class="text-white/90 leading-relaxed mb-6">Descripción</p>

        <ul id="modalBullets" class="space-y-2 mb-6 text-white/85 text-sm"></ul>

        <p id="modalNotes" class="text-white/70 text-sm italic border-t border-white/20 pt-4 mt-auto"></p>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
(() => {
  const modal = document.getElementById('productModal');
  const panel = modal?.querySelector('.card-choco-rose');
  const title = document.getElementById('modalTitle');
  const subtitle = document.getElementById('modalSubtitle');
  const desc = document.getElementById('modalDesc');
  const bullets = document.getElementById('modalBullets');
  const notes = document.getElementById('modalNotes');
  const carouselContainer = document.getElementById('carouselImages');
  const controls = document.getElementById('carouselControls');
  const dotsContainer = document.getElementById('carouselDots');
  const prevBtn = document.getElementById('prevBtn');
  const nextBtn = document.getElementById('nextBtn');

  let images = [];
  let currentIndex = 0;

  function openModal(data) {
    title.textContent = data.title || '';
    subtitle.textContent = data.subtitle || '';
    desc.textContent = data.desc || '';

    bullets.innerHTML = '';
    if (data.bullets && data.bullets.length) {
      data.bullets.forEach(b => {
        const li = document.createElement('li');
        li.className = 'flex items-start gap-2';
        li.innerHTML = `<span class="text-[var(--pistacho)] mt-1">✓</span><span>${b}</span>`;
        bullets.appendChild(li);
      });
    }

    notes.textContent = data.notes || '';
    notes.style.display = data.notes ? 'block' : 'none';

    images = data.images || [];
    currentIndex = 0;
    buildCarousel();

    modal.classList.remove('modal-hidden');
    modal.classList.add('modal-visible');
    setTimeout(() => {
      panel.classList.remove('modal-panel-enter');
      panel.classList.add('modal-panel-show');
    }, 10);
    document.body.style.overflow = 'hidden';
  }

  function closeModal() {
    panel.classList.remove('modal-panel-show');
    panel.classList.add('modal-panel-enter');
    setTimeout(() => {
      modal.classList.remove('modal-visible');
      modal.classList.add('modal-hidden');
      document.body.style.overflow = '';
    }, 250);
  }

  function buildCarousel() {
    if (!images.length) {
      carouselContainer.innerHTML = '<div class="w-full h-full flex items-center justify-center text-white/50 text-6xl">🍫</div>';
      controls.classList.add('hidden');
      return;
    }

    controls.classList.toggle('hidden', images.length <= 1);
    showImage(0);
    buildDots();
  }

  function showImage(index) {
    currentIndex = index;
    const src = images[index];
    carouselContainer.innerHTML = `<img src="${src}" alt="Producto" class="w-full h-full object-cover" loading="lazy" />`;
    updateDots();
  }

  function buildDots() {
    dotsContainer.innerHTML = '';
    images.forEach((_, i) => {
      const dot = document.createElement('button');
      dot.type = 'button';
      dot.className = 'carousel-dot focus-ring';
      dot.setAttribute('aria-label', `Ir a imagen ${i + 1}`);
      dot.setAttribute('aria-current', i === 0 ? 'true' : 'false');
      dot.addEventListener('click', () => showImage(i));
      dotsContainer.appendChild(dot);
    });
  }

  function updateDots() {
    dotsContainer.querySelectorAll('.carousel-dot').forEach((dot, i) => {
      dot.setAttribute('aria-current', i === currentIndex ? 'true' : 'false');
    });
  }

  prevBtn?.addEventListener('click', () => showImage((currentIndex - 1 + images.length) % images.length));
  nextBtn?.addEventListener('click', () => showImage((currentIndex + 1) % images.length));

  document.querySelectorAll('.open-modal').forEach(btn => {
    btn.addEventListener('click', () => {
      const data = {
        title: btn.dataset.title,
        subtitle: btn.dataset.subtitle,
        desc: btn.dataset.desc,
        bullets: JSON.parse(btn.dataset.bullets || '[]'),
        notes: btn.dataset.notes,
        images: JSON.parse(btn.dataset.images || '[]'),
      };
      openModal(data);
    });
  });

  document.querySelectorAll('.close-modal').forEach(btn => btn.addEventListener('click', closeModal));
  modal?.addEventListener('click', e => { if (e.target === modal) closeModal(); });
  document.addEventListener('keydown', e => { if (e.key === 'Escape' && modal.classList.contains('modal-visible')) closeModal(); });
})();
</script>
@endpush

@endsection
