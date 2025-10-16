@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
@endphp

@section('content')

<!-- Hero Cursos -->
<section class="relative overflow-hidden bg-gradient-to-br from-[#3d2817] via-[#5f3917] to-[#3d2817] py-24">
  <div class="absolute inset-0 opacity-10" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Ccircle cx=\'30\' cy=\'30\' r=\'2\'/%3E%3C/g%3E%3C/svg%3E');"></div>

  <div class="container-choco relative z-10">
    <div class="text-center max-w-4xl mx-auto">
      <h1 class="font-['Dancing_Script'] text-5xl md:text-6xl lg:text-7xl text-[#81cacf] mb-4 drop-shadow-lg">
        Academia Chocoart
      </h1>
      <p class="text-lg md:text-xl text-white/90 mb-8">
        Aprende el arte de la chocolatería profesional con nuestros expertos
      </p>
    </div>
  </div>

  <!-- Wave Divider Bottom -->
  <div class="absolute -bottom-1 left-0 w-full z-10 overflow-hidden">
    <svg class="w-full h-20 md:h-24" viewBox="0 0 1200 120" preserveAspectRatio="none">
      <path d="M0,60 Q50,20 100,60 T200,60 T300,60 T400,60 T500,60 T600,60 T700,60 T800,60 T900,60 T1000,60 T1100,60 T1200,60 L1200,120 L0,120 Z" fill="white"/>
    </svg>
  </div>
</section>

<!-- Cursos Section -->
<section class="py-20 bg-white relative">
  <style>
    :root{
      --rosa:#e28dc4;
      --menta:#81cacf;
      --pistacho:#c6d379;
      --choco:#5f3917;
    }

    .curso-card {
      position: relative;
      background: white;
      border-radius: 1.5rem;
      overflow: hidden;
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      border: 2px solid transparent;
    }
    .curso-card:hover {
      transform: translateY(-12px);
      box-shadow: 0 20px 40px rgba(95, 57, 23, 0.15);
      border-color: var(--rosa);
    }

    .curso-header {
      height: 180px;
      position: relative;
      overflow: hidden;
    }

    /* La imagen ocupa TODO el header cuando existe */
    .curso-header-img{
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;    /* cubre completo */
      object-position: center;
      z-index: 0;
    }
    /* Velito opcional para contraste de textos/badge */
    .curso-header::after{
      content:'';
      position:absolute;
      inset:0;
      background: linear-gradient(to bottom right, rgba(0,0,0,.08), rgba(0,0,0,.15));
      z-index: 1;
    }
    /* Contenido encima de la imagen */
    .curso-header-content{
      position: relative;
      z-index: 2;
    }

    .curso-icon { font-size: 4rem; transition: transform 0.4s ease; }
    .curso-card:hover .curso-icon { transform: scale(1.15) rotate(5deg); }

    .badge {
      position: absolute;
      top: 1rem;
      right: 1rem;
      padding: 0.5rem 1rem;
      border-radius: 2rem;
      font-size: 0.75rem;
      font-weight: 700;
      color: white;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      box-shadow: 0 4px 12px rgba(0,0,0,0.2);
      z-index: 10;
    }

    .curso-content { padding: 1.5rem; }

    .detail-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem;
      background: #f9fafb;
      border-radius: 0.75rem;
      transition: all 0.3s ease;
    }
    .detail-item:hover { background: #f3f4f6; transform: translateX(4px); }

    .detail-icon {
      width: 2.5rem;
      height: 2.5rem;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-shrink: 0;
    }

    .btn-curso {
      width: 100%;
      padding: 1rem;
      border-radius: 1rem;
      font-weight: 600;
      transition: all 0.3s ease;
      border: none;
      cursor: pointer;
      position: relative;
      overflow: hidden;
    }
    .btn-curso::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
      transition: left 0.5s ease;
    }
    .btn-curso:hover::before { left: 100%; }
    .btn-curso:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }

    @media (max-width: 768px) {
      .curso-header { height: 150px; }
      .curso-icon { font-size: 3rem; }
    }

    /* Círculo para fallback cuando NO hay imagen */
    .icon-wrap{
      width: 7rem;
      height: 7rem;
      border-radius: 9999px;
      overflow: hidden;
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 24px rgba(0,0,0,.15);
      background: rgba(255,255,255,0.35);
      backdrop-filter: blur(2px);
    }
    .icon-wrap img{
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }
  </style>

  <div class="container-choco">
    <div class="text-center mb-16">
      <h2 class="font-['Dancing_Script'] text-4xl md:text-5xl lg:text-6xl text-[var(--menta)] mb-3">
        I Nuestros Cursos I
      </h2>
      <p class="text-gray-600 max-w-2xl mx-auto text-lg">
        Desde fundamentos básicos hasta técnicas profesionales avanzadas
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto">
      @forelse($cursos as $curso)
      <!-- CURSO: {{ $curso->title }} -->
      <div class="curso-card">
        <div class="curso-header bg-gradient-to-br {{ $curso->color }}">
          @if($curso->badge)
          <div class="badge" style="background: linear-gradient(135deg, var(--pistacho), var(--menta));">
            {{ $curso->badge }}
          </div>
          @endif

          {{-- ====== ICONO / IMAGEN EN HEADER ====== --}}
          @php
              $iconRaw = $curso->icon;
              $isAbsolute = $iconRaw && Str::startsWith($iconRaw, ['http://','https://','//']);

              $iconPath = $iconRaw ?: '';
              if (Str::startsWith($iconPath, 'storage/')) $iconPath = Str::after($iconPath, 'storage/');
              if (Str::startsWith($iconPath, 'public/'))  $iconPath = Str::after($iconPath, 'public/');

              // usamos /media/ (tu ruta que sirve el disk public)
              $iconUrl = $isAbsolute ? $iconRaw : ($iconPath ? url('media/'.$iconPath) : null);

              $exists = $iconPath ? Storage::disk('public')->exists($iconPath) : false;
          @endphp

          {{-- Si hay imagen: cubrir TODO el header --}}
          @if(($isAbsolute && $iconUrl) || $exists)
            <img src="{{ $iconUrl }}" alt="{{ $curso->title }}" class="curso-header-img" loading="lazy">
          @endif

          {{-- Contenido del header: solo mostramos círculo/emoji si NO hay imagen --}}
          <div class="curso-header-content w-full h-full flex items-center justify-center">
            @unless(($isAbsolute && $iconUrl) || $exists)
              <div class="curso-icon relative">
                <div class="icon-wrap">
                  <span class="text-7xl">{{ $curso->icon ?? '🍫' }}</span>
                </div>
              </div>
            @endunless
          </div>
          {{-- ====== FIN ICONO / IMAGEN ====== --}}
        </div>

        <div class="curso-content">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-2">{{ $curso->title }}</h3>
          <p class="text-gray-500 mb-4 text-sm">{{ $curso->description }}</p>

          <div class="space-y-3 mb-6">
            <div class="detail-item">
              <div class="detail-icon bg-[var(--pistacho)]/20">
                <svg class="w-5 h-5 text-[var(--pistacho)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Duración</div>
                <div class="text-sm font-semibold text-[var(--choco)]">{{ $curso->duration_hours }} horas</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--pistacho)]/20">
                <svg class="w-5 h-5 text-[var(--pistacho)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Capacidad</div>
                <div class="text-sm font-semibold text-[var(--choco)]">
                  @if($curso->max_students)
                    Máx. {{ $curso->max_students }} personas
                  @else
                    Flexible
                  @endif
                </div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--pistacho)]/20">
                <svg class="w-5 h-5 text-[var(--pistacho)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Nivel</div>
                <div class="text-sm font-semibold text-[var(--choco)]">{{ $curso->level }}</div>
              </div>
            </div>
          </div>

          <a href="{{ route('contacto') }}" class="btn-curso bg-gradient-to-r {{ $curso->color }} text-white">
            Inscríbete Ahora
          </a>
        </div>
      </div>
      @empty
      <div class="col-span-3 text-center py-12">
        <p class="text-gray-500 text-lg">No hay cursos disponibles en este momento.</p>
      </div>
      @endforelse
    </div>
  </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
