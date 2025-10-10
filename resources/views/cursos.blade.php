@extends('layouts.app')

@section('title', 'Cursos - Chocoart')

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

    .curso-icon {
      font-size: 4rem;
      transition: transform 0.4s ease;
    }

    .curso-card:hover .curso-icon {
      transform: scale(1.15) rotate(5deg);
    }

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

    .curso-content {
      padding: 1.5rem;
    }

    .detail-item {
      display: flex;
      align-items: center;
      gap: 0.75rem;
      padding: 0.75rem;
      background: #f9fafb;
      border-radius: 0.75rem;
      transition: all 0.3s ease;
    }

    .detail-item:hover {
      background: #f3f4f6;
      transform: translateX(4px);
    }

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

    .btn-curso:hover::before {
      left: 100%;
    }

    .btn-curso:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    }

    @media (max-width: 768px) {
      .curso-header {
        height: 150px;
      }
      .curso-icon {
        font-size: 3rem;
      }
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

      <!-- CURSO 1: Choco Art academy Principiantes -->
      <div class="curso-card">
        <div class="curso-header bg-gradient-to-br from-[#c6d379] to-[#81cacf] flex items-center justify-center">
          <div class="badge" style="background: linear-gradient(135deg, var(--pistacho), var(--menta));">
            POPULAR
          </div>
          <div class="curso-icon">📚</div>
        </div>

        <div class="curso-content">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-2">Choco Art Academy Principiantes</h3>
          <p class="text-gray-500 mb-4 text-sm">Fundamentos de chocolatería artesanal</p>

          <div class="space-y-3 mb-6">
            <div class="detail-item">
              <div class="detail-icon bg-[var(--pistacho)]/20">
                <svg class="w-5 h-5 text-[var(--pistacho)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Duración</div>
                <div class="text-sm font-semibold text-[var(--choco)]">8 horas</div>
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
                <div class="text-sm font-semibold text-[var(--choco)]">Máx. 8 personas</div>
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
                <div class="text-sm font-semibold text-[var(--choco)]">Principiante</div>
              </div>
            </div>
          </div>

          <a href="{{ route('contacto') }}" class="btn-curso bg-gradient-to-r from-[var(--pistacho)] to-[var(--menta)] text-white">
            Inscríbete Ahora
          </a>
        </div>
      </div>

      <!-- CURSO 2: Intermedio-Avanzado -->
      <div class="curso-card">
        <div class="curso-header bg-gradient-to-br from-[#e28dc4] to-[#5f3917] flex items-center justify-center">
          <div class="badge" style="background: linear-gradient(135deg, var(--rosa), var(--choco));">
            AVANZADO
          </div>
          <div class="curso-icon">🎓</div>
        </div>

        <div class="curso-content">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-2">Choco Art Academy Intermedio-Avanzado</h3>
          <p class="text-gray-500 mb-4 text-sm">Técnicas profesionales y templado perfecto</p>

          <div class="space-y-3 mb-6">
            <div class="detail-item">
              <div class="detail-icon bg-[var(--rosa)]/20">
                <svg class="w-5 h-5 text-[var(--rosa)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Duración</div>
                <div class="text-sm font-semibold text-[var(--choco)]">12 horas</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--rosa)]/20">
                <svg class="w-5 h-5 text-[var(--rosa)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm9.707 5.707a1 1 0 00-1.414-1.414L9 12.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Incluye</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Certificación</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--rosa)]/20">
                <svg class="w-5 h-5 text-[var(--rosa)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Nivel</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Intermedio</div>
              </div>
            </div>
          </div>

          <a href="{{ route('contacto') }}" class="btn-curso bg-gradient-to-r from-[var(--rosa)] to-[var(--choco)] text-white">
            Inscríbete Ahora
          </a>
        </div>
      </div>

      <!-- CURSO 3: Personalizado -->
      <div class="curso-card">
        <div class="curso-header bg-gradient-to-br from-[#81cacf] to-[#e28dc4] flex items-center justify-center">
          <div class="badge" style="background: linear-gradient(135deg, var(--menta), var(--rosa));">
            PERSONALIZADO
          </div>
          <div class="curso-icon">⭐</div>
        </div>

        <div class="curso-content">
          <h3 class="text-2xl font-bold text-[var(--choco)] mb-2">Choco Art Academy Personalizado</h3>
          <p class="text-gray-500 mb-4 text-sm">Curso diseñado a tu medida según tus necesidades</p>

          <div class="space-y-3 mb-6">
            <div class="detail-item">
              <div class="detail-icon bg-[var(--menta)]/20">
                <svg class="w-5 h-5 text-[var(--menta)]" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Duración</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Flexible</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--menta)]/20">
                <svg class="w-5 h-5 text-[var(--menta)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Capacidad</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Individual o grupo</div>
              </div>
            </div>

            <div class="detail-item">
              <div class="detail-icon bg-[var(--menta)]/20">
                <svg class="w-5 h-5 text-[var(--menta)]" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              </div>
              <div>
                <div class="text-xs text-gray-500">Nivel</div>
                <div class="text-sm font-semibold text-[var(--choco)]">Todos los niveles</div>
              </div>
            </div>
          </div>

          <a href="{{ route('contacto') }}" class="btn-curso bg-gradient-to-r from-[var(--menta)] to-[var(--rosa)] text-white">
            Inscríbete Ahora
          </a>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('js/animations.js') }}"></script>
@endpush
