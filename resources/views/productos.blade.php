@extends('layouts.app')

@section('title', 'Productos - Chocoart')

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

  <!-- Wave Divider Bottom -->
  <div class="absolute -bottom-1 left-0 w-full z-10">
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
        I Catálogo de Chocolates I
      </h2>
      <p class="text-gray-600 max-w-2xl mx-auto text-lg">
        Explora nuestra colección de chocolates artesanales premium
      </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">

      <!-- ===== PRODUCTO 1 - Bombón Menta ===== -->
      <div class="group relative">
        <div class="relative mb-6">
          <!-- Badge -->
          <div class="absolute -top-3 right-1/4 z-30">
            <div class="relative px-4 py-1 bg-[var(--pistacho)] text-white text-xs font-bold rounded-full shadow-lg">
              NUEVO
              <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[6px] border-l-transparent border-r-transparent border-t-[var(--pistacho)]"></div>
            </div>
          </div>

          <!-- Cápsula + Aro -->
          <div class="relative w-56 h-56 mx-auto isolate">
            <div class="absolute inset-0 rounded-full blur-2xl" style="background: radial-gradient(60% 60% at 30% 20%, color-mix(in srgb, var(--menta) 35%, white 0%) 0%, transparent 70%), radial-gradient(60% 60% at 70% 80%, color-mix(in srgb, var(--pistacho) 35%, white 0%) 0%, transparent 70%);"></div>

            <!-- Aro chocolate -->
            <svg viewBox="0 0 200 200" class="ring-wrap absolute inset-0 z-20 pointer-events-none transition-transform duration-300"
                 aria-hidden="true"
                 style="--ring-hover:6s; mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%); -webkit-mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%);">
              <defs><path id="circlePath-1" d="M100,100 m-86,0 a86,86 0 1,1 172,0 a86,86 0 1,1 -172,0"/></defs>
              <g class="text-ring">
                <text font-size="14.5" font-weight="600" fill="var(--choco)" letter-spacing="3">
                  <textPath href="#circlePath-1">• CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART •</textPath>
                </text>
              </g>
              <circle cx="100" cy="100" r="90" fill="none" stroke="var(--choco)" stroke-width="1.5" opacity=".25"/>
            </svg>

            <!-- Cápsula -->
            <div class="capsule relative z-10 w-full h-full bg-gradient-to-br from-[color-mix(in_srgb,var(--menta) 50%,white_0%)] to-[color-mix(in_srgb,var(--menta) 10%,var(--choco) 90%)] rounded-full shadow-2xl flex items-center justify-center transition-transform duration-500">
              <div class="emoji text-7xl transition-transform duration-300">🍫</div>
            </div>
          </div>
        </div>

        <div class="text-center">
          <h3 class="text-2xl font-semibold text-[var(--choco)] mb-2">Bombón Menta</h3>
          <p class="text-gray-500 text-sm mb-3">Refrescante sabor a menta</p>
          <button
            type="button"
            class="open-modal btn-choco focus-ring inline-block px-6 py-2 rounded-full font-semibold transition"
            data-title="Bombón Menta"
            data-subtitle="Refrescante, equilibrado y aromático"
            data-desc="El frescor de la menta natural se fusiona con cacao de origen para una sensación ligera y vivaz."
            data-bullets='["70% cacao fino de aroma","Esencia natural de menta","Textura cremosa","Sin colorantes artificiales"]'
            data-notes="Marida con: té verde, cítricos o espresso corto."
            data-images='[]'
          >Leer Más</button>
        </div>
      </div>

      <!-- ===== PRODUCTO 2 - Bombón Frambuesa ===== -->
      <div class="group relative">
        <div class="relative mb-6">
          <div class="absolute -top-3 right-1/4 z-30">
            <div class="relative px-4 py-1 bg-[var(--choco)] text-white text-xs font-bold rounded-full shadow-lg">
              DESTACADO
              <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[6px] border-l-transparent border-r-transparent border-t-[var(--choco)]"></div>
            </div>
          </div>

          <div class="relative w-56 h-56 mx-auto isolate">
            <div class="absolute inset-0 rounded-full blur-2xl" style="background: radial-gradient(60% 60% at 30% 20%, color-mix(in srgb, var(--rosa) 35%, white 0%) 0%, transparent 70%), radial-gradient(60% 60% at 70% 80%, color-mix(in srgb, var(--choco) 30%, white 0%) 0%, transparent 70%);"></div>

            <svg viewBox="0 0 200 200" class="ring-wrap absolute inset-0 z-20 pointer-events-none transition-transform duration-300"
                 aria-hidden="true"
                 style="--ring-hover:6s; mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%); -webkit-mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%);">
              <defs><path id="circlePath-2" d="M100,100 m-86,0 a86,86 0 1,1 172,0 a86,86 0 1,1 -172,0"/></defs>
              <g class="text-ring fast">
                <text font-size="14.5" font-weight="600" fill="var(--choco)" letter-spacing="3">
                  <textPath href="#circlePath-2">• CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART •</textPath>
                </text>
              </g>
              <circle cx="100" cy="100" r="90" fill="none" stroke="var(--choco)" stroke-width="1.5" opacity=".25"/>
            </svg>

            <div class="capsule relative z-10 w-full h-full bg-gradient-to-br from-[color-mix(in_srgb,var(--rosa) 35%,white_0%)] to-[color-mix(in_srgb,var(--choco) 85%,white_0%)] rounded-full shadow-2xl flex items-center justify-center transition-transform duration-500">
              <div class="emoji text-7xl transition-transform duration-300">🍫</div>
            </div>
          </div>
        </div>

        <div class="text-center">
          <h3 class="text-2xl font-semibold text-[var(--choco)] mb-2">Bombón Frambuesa</h3>
          <p class="text-gray-500 text-sm mb-3">Dulce y afrutado</p>
          <button
            type="button"
            class="open-modal btn-choco focus-ring inline-block px-6 py-2 rounded-full font-semibold transition"
            data-title="Bombón Frambuesa"
            data-subtitle="Frutal, vibrante y seductor"
            data-desc="La frambuesa liofilizada aporta un toque ácido-dulce que realza las notas del cacao."
            data-bullets='["Cacao 60% afrutado","Frambuesa liofilizada premium","Crujiente en cada bocado","Perfil intenso"]'
            data-notes="Marida con: vino rosado fresco o espumante."
            data-images='[]'
          >Leer Más</button>
        </div>
      </div>

      <!-- ===== PRODUCTO 3 - Bombón Mango ===== -->
      <div class="group relative">
        <div class="relative mb-6">
          <div class="absolute -top-3 right-1/4 z-30">
            <div class="relative px-4 py-1 bg-[var(--pistacho)] text-white text-xs font-bold rounded-full shadow-lg">
              NUEVO
              <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[6px] border-l-transparent border-r-transparent border-t-[var(--pistacho)]"></div>
            </div>
          </div>

          <div class="relative w-56 h-56 mx-auto isolate">
            <div class="absolute inset-0 rounded-full blur-2xl" style="background: radial-gradient(60% 60% at 30% 20%, color-mix(in srgb, var(--pistacho) 35%, white 0%) 0%, transparent 70%), radial-gradient(60% 60% at 70% 80%, color-mix(in srgb, var(--menta) 30%, white 0%) 0%, transparent 70%);"></div>

            <svg viewBox="0 0 200 200" class="ring-wrap absolute inset-0 z-20 pointer-events-none transition-transform duration-300"
                 aria-hidden="true"
                 style="--ring-hover:6.5s; mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%); -webkit-mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%);">
              <defs><path id="circlePath-3" d="M100,100 m-86,0 a86,86 0 1,1 172,0 a86,86 0 1,1 -172,0"/></defs>
              <g class="text-ring slow">
                <text font-size="14.5" font-weight="600" fill="var(--choco)" letter-spacing="3">
                  <textPath href="#circlePath-3">• CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART •</textPath>
                </text>
              </g>
              <circle cx="100" cy="100" r="90" fill="none" stroke="var(--choco)" stroke-width="1.5" opacity=".25"/>
            </svg>

            <div class="capsule relative z-10 w-full h-full bg-gradient-to-br from-[color-mix(in_srgb,var(--pistacho) 35%,white_0%)] to-[color-mix(in_srgb,var(--choco) 85%,white_0%)] rounded-full shadow-2xl flex items-center justify-center transition-transform duration-500">
              <div class="emoji text-7xl transition-transform duration-300">🍫</div>
            </div>
          </div>
        </div>

        <div class="text-center">
          <h3 class="text-2xl font-semibold text-[var(--choco)] mb-2">Bombón Mango</h3>
          <p class="text-gray-500 text-sm mb-3">Tropical y exótico</p>
          <button
            type="button"
            class="open-modal btn-choco focus-ring inline-block px-6 py-2 rounded-full font-semibold transition"
            data-title="Bombón Mango"
            data-subtitle="Exótico, jugoso y solar"
            data-desc="Notas tropicales de mango con cacao medio; dulzor natural y final prolongado."
            data-bullets='["Cacao 55% balanceado","Tropezones de mango","Aroma tropical","Perfecto para días cálidos"]'
            data-notes="Marida con: limonadas, cervezas ligeras o helado de vainilla."
            data-images='[]'
          >Leer Más</button>
        </div>
      </div>

      <!-- ===== PRODUCTO 4 - Tableta Caramelo Salado ===== -->
      <div class="group relative">
        <div class="relative mb-6">
          <div class="absolute -top-3 right-1/4 z-30">
            <div class="relative px-4 py-1 bg-[var(--rosa)] text-white text-xs font-bold rounded-full shadow-lg">
              PREMIUM
              <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[6px] border-l-transparent border-r-transparent border-t-[var(--rosa)]"></div>
            </div>
          </div>

          <div class="relative w-56 h-56 mx-auto isolate">
            <div class="absolute inset-0 rounded-full blur-2xl" style="background: radial-gradient(60% 60% at 30% 20%, color-mix(in srgb, var(--choco) 35%, white 0%) 0%, transparent 70%), radial-gradient(60% 60% at 70% 80%, color-mix(in srgb, var(--rosa) 30%, white 0%) 0%, transparent 70%);"></div>

            <svg viewBox="0 0 200 200" class="ring-wrap absolute inset-0 z-20 pointer-events-none transition-transform duration-300"
                 aria-hidden="true"
                 style="--ring-hover:7s; mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%); -webkit-mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%);">
              <defs><path id="circlePath-4" d="M100,100 m-86,0 a86,86 0 1,1 172,0 a86,86 0 1,1 -172,0"/></defs>
              <g class="text-ring">
                <text font-size="14.5" font-weight="600" fill="var(--choco)" letter-spacing="3">
                  <textPath href="#circlePath-4">• CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART •</textPath>
                </text>
              </g>
              <circle cx="100" cy="100" r="90" fill="none" stroke="var(--choco)" stroke-width="1.5" opacity=".25"/>
            </svg>

            <div class="capsule relative z-10 w-full h-full bg-gradient-to-br from-[color-mix(in_srgb,var(--choco) 40%,white_0%)] to-[color-mix(in_srgb,var(--rosa) 35%,var(--choco) 65%)] rounded-full shadow-2xl flex items-center justify-center transition-transform duration-500">
              <div class="emoji text-7xl transition-transform duration-300">🍫</div>
            </div>
          </div>
        </div>

        <div class="text-center">
          <h3 class="text-2xl font-semibold text-[var(--choco)] mb-2">Tableta Caramelo Salado</h3>
          <p class="text-gray-500 text-sm mb-3">Dulce con toque de sal</p>
          <button
            type="button"
            class="open-modal btn-choco focus-ring inline-block px-6 py-2 rounded-full font-semibold transition"
            data-title="Tableta Caramelo Salado"
            data-subtitle="Equilibrio perfecto dulce-salado"
            data-desc="Chocolate oscuro con caramelo artesanal y flor de sal marina. Una combinación adictiva."
            data-bullets='["Cacao 65% de origen único","Caramelo artesanal","Flor de sal marina","Textura crujiente"]'
            data-notes="Marida con: café negro, whisky o cerveza porter."
            data-images='[]'
          >Leer Más</button>
        </div>
      </div>

      <!-- ===== PRODUCTO 5 - Trufa Avellanas ===== -->
      <div class="group relative">
        <div class="relative mb-6">
          <div class="absolute -top-3 right-1/4 z-30">
            <div class="relative px-4 py-1 bg-[var(--menta)] text-white text-xs font-bold rounded-full shadow-lg">
              CLÁSICO
              <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[6px] border-l-transparent border-r-transparent border-t-[var(--menta)]"></div>
            </div>
          </div>

          <div class="relative w-56 h-56 mx-auto isolate">
            <div class="absolute inset-0 rounded-full blur-2xl" style="background: radial-gradient(60% 60% at 30% 20%, color-mix(in srgb, var(--menta) 35%, white 0%) 0%, transparent 70%), radial-gradient(60% 60% at 70% 80%, color-mix(in srgb, var(--choco) 30%, white 0%) 0%, transparent 70%);"></div>

            <svg viewBox="0 0 200 200" class="ring-wrap absolute inset-0 z-20 pointer-events-none transition-transform duration-300"
                 aria-hidden="true"
                 style="--ring-hover:6s; mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%); -webkit-mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%);">
              <defs><path id="circlePath-5" d="M100,100 m-86,0 a86,86 0 1,1 172,0 a86,86 0 1,1 -172,0"/></defs>
              <g class="text-ring fast">
                <text font-size="14.5" font-weight="600" fill="var(--choco)" letter-spacing="3">
                  <textPath href="#circlePath-5">• CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART •</textPath>
                </text>
              </g>
              <circle cx="100" cy="100" r="90" fill="none" stroke="var(--choco)" stroke-width="1.5" opacity=".25"/>
            </svg>

            <div class="capsule relative z-10 w-full h-full bg-gradient-to-br from-[color-mix(in_srgb,var(--menta) 30%,white_0%)] to-[color-mix(in_srgb,var(--choco) 90%,white_0%)] rounded-full shadow-2xl flex items-center justify-center transition-transform duration-500">
              <div class="emoji text-7xl transition-transform duration-300">🍬</div>
            </div>
          </div>
        </div>

        <div class="text-center">
          <h3 class="text-2xl font-semibold text-[var(--choco)] mb-2">Trufa Avellanas</h3>
          <p class="text-gray-500 text-sm mb-3">Cremosa y crujiente</p>
          <button
            type="button"
            class="open-modal btn-choco focus-ring inline-block px-6 py-2 rounded-full font-semibold transition"
            data-title="Trufa Avellanas"
            data-subtitle="Cremosidad irresistible"
            data-desc="Ganache de chocolate con leche y avellanas tostadas. Cubierta de cacao en polvo."
            data-bullets='["Chocolate con leche 40%","Avellanas piamonte tostadas","Ganache sedoso","Acabado en cacao puro"]'
            data-notes="Marida con: champagne, café con leche o té chai."
            data-images='[]'
          >Leer Más</button>
        </div>
      </div>

      <!-- ===== PRODUCTO 6 - Figura Corazón ===== -->
      <div class="group relative">
        <div class="relative mb-6">
          <div class="absolute -top-3 right-1/4 z-30">
            <div class="relative px-4 py-1 bg-[var(--rosa)] text-white text-xs font-bold rounded-full shadow-lg">
              ESPECIAL
              <div class="absolute -bottom-1 left-1/2 -translate-x-1/2 w-0 h-0 border-l-[6px] border-r-[6px] border-t-[6px] border-l-transparent border-r-transparent border-t-[var(--rosa)]"></div>
            </div>
          </div>

          <div class="relative w-56 h-56 mx-auto isolate">
            <div class="absolute inset-0 rounded-full blur-2xl" style="background: radial-gradient(60% 60% at 30% 20%, color-mix(in srgb, var(--rosa) 40%, white 0%) 0%, transparent 70%), radial-gradient(60% 60% at 70% 80%, color-mix(in srgb, var(--pistacho) 30%, white 0%) 0%, transparent 70%);"></div>

            <svg viewBox="0 0 200 200" class="ring-wrap absolute inset-0 z-20 pointer-events-none transition-transform duration-300"
                 aria-hidden="true"
                 style="--ring-hover:6.5s; mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%); -webkit-mask-image: radial-gradient(circle at 50% 50%, transparent 41%, black 43%);">
              <defs><path id="circlePath-6" d="M100,100 m-86,0 a86,86 0 1,1 172,0 a86,86 0 1,1 -172,0"/></defs>
              <g class="text-ring slow">
                <text font-size="14.5" font-weight="600" fill="var(--choco)" letter-spacing="3">
                  <textPath href="#circlePath-6">• CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART • CHOCO ART •</textPath>
                </text>
              </g>
              <circle cx="100" cy="100" r="90" fill="none" stroke="var(--choco)" stroke-width="1.5" opacity=".25"/>
            </svg>

            <div class="capsule relative z-10 w-full h-full bg-gradient-to-br from-[color-mix(in_srgb,var(--rosa) 45%,white_0%)] to-[color-mix(in_srgb,var(--pistacho) 25%,var(--choco) 75%)] rounded-full shadow-2xl flex items-center justify-center transition-transform duration-500">
              <div class="emoji text-7xl transition-transform duration-300">🎁</div>
            </div>
          </div>
        </div>

        <div class="text-center">
          <h3 class="text-2xl font-semibold text-[var(--choco)] mb-2">Figura Personalizada</h3>
          <p class="text-gray-500 text-sm mb-3">Para ocasiones especiales</p>
          <button
            type="button"
            class="open-modal btn-choco focus-ring inline-block px-6 py-2 rounded-full font-semibold transition"
            data-title="Figura Personalizada"
            data-subtitle="Hecho a tu medida"
            data-desc="Figuras de chocolate personalizadas para bodas, cumpleaños, eventos corporativos y más."
            data-bullets='["Diseño personalizado","Chocolate premium a elegir","Tamaños variados","Empaque de regalo"]'
            data-notes="Pedidos con 7 días de anticipación. Consulta por diseños especiales."
            data-images='[]'
          >Leer Más</button>
        </div>
      </div>

    </div>
  </div>

  <!-- ===== MODAL con CARRUSEL (paleta aplicada) ===== -->
  <div id="productModal" class="fixed inset-0 z-[100] flex items-center justify-center modal-hidden transition-opacity duration-200">
    <div id="modalBackdrop" class="absolute inset-0 bg-black/60"></div>

    <div role="dialog" aria-modal="true" aria-labelledby="modalTitle" aria-describedby="modalDesc"
      class="modal-panel relative w-[92%] max-w-md mx-auto rounded-[28px] card-choco-rose inner-shadow soft-ring text-white transition-all duration-200 modal-panel-enter overflow-hidden">

      <!-- Carrusel -->
      <div class="relative">
        <div class="aspect-[4/3] bg-black/10 overflow-hidden">
          <img id="carouselImage" src="" alt="Galería del producto" class="w-full h-full object-cover">
        </div>

        <button id="prevBtn" class="carousel-arrow absolute left-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full flex items-center justify-center" aria-label="Anterior">‹</button>
        <button id="nextBtn" class="carousel-arrow absolute right-3 top-1/2 -translate-y-1/2 w-9 h-9 rounded-full flex items-center justify-center" aria-label="Siguiente">›</button>

        <div id="carouselDots" class="absolute bottom-2 left-0 right-0 flex items-center justify-center gap-2"></div>
      </div>

      <!-- Contenido -->
      <div class="p-8 pt-6 text-center">
        <h3 id="modalTitle" class="font-['Dancing_Script'] text-4xl leading-tight drop-shadow">Título</h3>
        <p id="modalSubtitle" class="mt-1 text-white/85 italic">Subtítulo</p>

        <p id="modalDesc" class="mt-4 text-sm leading-relaxed text-white/90">Descripción del producto…</p>

        <ul id="modalBullets" class="mt-5 grid grid-cols-1 gap-2 text-white/90 text-sm"></ul>

        <div id="modalNotes" class="mt-4 text-xs text-white/85 opacity-90">Notas, maridajes o conservación…</div>

        <div class="mt-7 flex justify-center gap-3">
          <a href="{{ route('contacto') }}" class="btn-outline-light focus-ring inline-flex items-center justify-center px-6 py-2 rounded-full soft-ring transition text-sm font-semibold">
            Solicitar Pedido
          </a>
        </div>
      </div>

      <button id="modalClose" class="absolute top-3 right-3 text-white/85 hover:text-white transition" aria-label="Cerrar">✕</button>
    </div>
  </div>

  <!-- ===== SCRIPT modal + carrusel ===== -->
  <script>
    (() => {
      const modal = document.getElementById('productModal');
      const panel = modal.querySelector('.modal-panel');
      const backdrop = document.getElementById('modalBackdrop');
      const closeBtn = document.getElementById('modalClose');

      const titleEl = document.getElementById('modalTitle');
      const subtitleEl = document.getElementById('modalSubtitle');
      const descEl = document.getElementById('modalDesc');
      const bulletsEl = document.getElementById('modalBullets');
      const notesEl = document.getElementById('modalNotes');

      const imgEl = document.getElementById('carouselImage');
      const dotsEl = document.getElementById('carouselDots');
      const prevBtn = document.getElementById('prevBtn');
      const nextBtn = document.getElementById('nextBtn');

      let images = [];
      let index = 0;
      let touchStartX = 0;

      const openButtons = document.querySelectorAll('.open-modal');

      function renderImage() {
        if (!images.length) { imgEl.removeAttribute('src'); dotsEl.innerHTML=''; return; }
        imgEl.src = images[index];

        dotsEl.innerHTML = '';
        images.forEach((_, i) => {
          const b = document.createElement('button');
          b.className = 'carousel-dot';
          b.setAttribute('aria-label', 'Ir a la imagen ' + (i+1));
          if (i === index) b.setAttribute('aria-current','true');
          b.addEventListener('click', () => { index = i; renderImage(); });
          dotsEl.appendChild(b);
        });
      }

      function next(){ if(!images.length) return; index = (index+1) % images.length; renderImage(); }
      function prev(){ if(!images.length) return; index = (index-1+images.length) % images.length; renderImage(); }

      function openModalFromButton(btn){
        // Texto
        titleEl.textContent = btn.dataset.title || 'Producto';
        subtitleEl.textContent = btn.dataset.subtitle || '';
        descEl.textContent = btn.dataset.desc || '';
        notesEl.textContent = btn.dataset.notes || '';

        bulletsEl.innerHTML = '';
        try{
          const bullets = JSON.parse(btn.dataset.bullets || '[]');
          bullets.forEach(t => {
            const li = document.createElement('li');
            li.className = 'flex items-center gap-2 justify-center';
            li.innerHTML = `<span class="inline-block w-1.5 h-1.5 rounded-full" style="background: var(--menta)"></span><span>${t}</span>`;
            bulletsEl.appendChild(li);
          });
        }catch(e){}

        // Imágenes
        try{ images = JSON.parse(btn.dataset.images || '[]'); }catch(e){ images = []; }
        index = 0; renderImage();

        // Mostrar
        modal.classList.remove('modal-hidden'); modal.classList.add('modal-visible');
        requestAnimationFrame(()=>{ panel.classList.remove('modal-panel-enter'); panel.classList.add('modal-panel-show'); });
        document.addEventListener('keydown', onEsc);
      }

      function closeModal(){
        panel.classList.remove('modal-panel-show'); panel.classList.add('modal-panel-enter');
        modal.classList.remove('modal-visible'); modal.classList.add('modal-hidden');
        document.removeEventListener('keydown', onEsc);
      }
      function onEsc(e){ if(e.key==='Escape') closeModal(); }

      // Eventos
      openButtons.forEach(btn => btn.addEventListener('click', () => openModalFromButton(btn)));
      backdrop.addEventListener('click', closeModal);
      closeBtn.addEventListener('click', closeModal);

      nextBtn.addEventListener('click', next);
      prevBtn.addEventListener('click', prev);
      document.addEventListener('keydown', e => {
        if(!modal.classList.contains('modal-visible')) return;
        if(e.key==='ArrowRight') next();
        if(e.key==='ArrowLeft') prev();
      });

      // Swipe móvil
      imgEl.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, {passive:true});
      imgEl.addEventListener('touchend', e => {
        const dx = e.changedTouches[0].clientX - touchStartX;
        if(Math.abs(dx)>40){ dx<0 ? next() : prev(); }
      }, {passive:true});
    })();
  </script>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
